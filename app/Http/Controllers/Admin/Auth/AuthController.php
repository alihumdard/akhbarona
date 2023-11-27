<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Events\User\LoggedIn;
use App\Events\User\LoggedOut;
use App\Events\User\Registered;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Services\Auth\TwoFactor\Contracts\Authenticatable;
use App\Support\Enum\UserStatus;
use Auth;
use Authy;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Validator;

class AuthController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * Create a new authentication controller instance.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('admin', ['except' => ['getLogout']]);
        $this->middleware('admin', ['only' => ['getLogout']]);
        $this->users = $users;
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        $socialProviders = config('auth.social.providers');
        return view('admin.auth.login', compact('socialProviders'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|AuthController
     */
    public function postLogin(LoginRequest $request)
    {

        $credentials = $request->getCredentials();
        if (! Auth::validate($credentials)) {
            $userName = $request->username;
            $password = md5($request->password);
            $user = User::where("username",$userName)->first();
            if(!$user || $user->password != $password) {
                return redirect()->to(route('adminLogin'))
                    ->withErrors(trans('auth.failed'));
            }
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        //dd($user);
        if ($user->isUnconfirmed()) {
            return redirect()->to(route('adminLogin'))
                ->withErrors(trans('app.please_confirm_your_email_first'));
        }
        if (!$user->isAdmin()) {
            return redirect()->to(route('adminLogin'))
                ->withErrors("You don't have permission");
        }

        if ($user->isBanned()) {
            return redirect()->to(route('adminLogin'))
                ->withErrors(trans('app.your_account_is_banned'));
        }
        //dd($credentials);
        Auth::guard('admin')->login($user, $request->get('remember'));
        $user->last_login = now();
        $user->save();
        return $this->handleUserWasAuthenticated($request,  $user);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  Request $request
     * @param  bool $throttles
     * @param $user
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $user)
    {

       // event(new LoggedIn);

        if ($request->has('to')) {
            return redirect()->to($request->get('to'));
        }
        return redirect()->intended(route('dashboard'));
    }

    protected function logoutAndRedirectToTokenPage(Request $request, Authenticatable $user)
    {
        Auth::logout();

        $request->session()->put('auth.2fa.id', $user->userid);

        return redirect()->route('auth.token');
    }

    public function getToken()
    {
        return session('admin.auth.2fa.id') ? view('admin.auth.token') : redirect('login');
    }

    public function postToken(Request $request)
    {
        $this->validate($request, ['token' => 'required']);

        if (! session('auth.2fa.id')) {
            return redirect('login');
        }

        $user = $this->users->find(
            $request->session()->pull('auth.2fa.id')
        );

        if (! $user) {
            throw new NotFoundHttpException;
        }

        Auth::login($user);

        event(new LoggedIn);

        return redirect()->intended('/');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        event(new LoggedOut);

        Auth::logout();

        return redirect(route('adminLogin'));
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return 'username';
    }

    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return app(RateLimiter::class)->tooManyAttempts(
            $request->input($this->loginUsername()).$request->ip(),
            $this->maxLoginAttempts()
        );
    }

    /**
     * Increment the login attempts for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return int
     */
    protected function incrementLoginAttempts(Request $request)
    {
        app(RateLimiter::class)->hit(
            $request->input($this->loginUsername()).$request->ip(),
            $this->lockoutTime() / 60
        );
    }

    /**
     * Determine how many retries are left for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return int
     */
    protected function retriesLeft(Request $request)
    {
        $attempts = app(RateLimiter::class)->attempts(
            $request->input($this->loginUsername()).$request->ip()
        );

        return $this->maxLoginAttempts() - $attempts + 1;
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = app(RateLimiter::class)->availableIn(
            $request->input($this->loginUsername()).$request->ip()
        );

        return redirect()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getLockoutErrorMessage($seconds),
            ]);
    }

    /**
     * Get the login lockout error message.
     *
     * @param  int  $seconds
     * @return string
     */
    protected function getLockoutErrorMessage($seconds)
    {
        return trans('auth.throttle', ['seconds' => $seconds]);
    }

    /**
     * Clear the login locks for the given user credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function clearLoginAttempts(Request $request)
    {
        app(RateLimiter::class)->clear(
            $request->input($this->loginUsername()).$request->ip()
        );
    }

    /**
     * Get the maximum number of login attempts for delaying further attempts.
     *
     * @return int
     */
    protected function maxLoginAttempts()
    {
        return 3;
    }

    /**
     * The number of seconds to delay further login attempts.
     *
     * @return int
     */
    protected function lockoutTime()
    {
        return 600;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return;
        $socialProviders = config('auth.social.providers');

        return view('auth.register', compact('socialProviders'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param RegisterRequest $request
     * @param RoleRepository $roles
     * @return \Illuminate\Http\Response
     */
    public function postRegister(RegisterRequest $request, RoleRepository $roles)
    {
        // Determine user status. User's status will be set to UNCONFIRMED
        // if he has to confirm his email or to ACTIVE if email confirmation is not required
        $status = UserStatus::ACTIVE;

        $role = $roles->findByName('User');

        // Add the user to database
        $user = $this->users->create(array_merge(
            $request->only('email', 'username', 'password'),
            ['status' => $status, 'role_id' => $role->id]
        ));

        event(new Registered($user));

        $message = trans('app.account_created_login');

        return redirect('login')->with('success', $message);
    }

    /**
     * Confirm user's email.
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmEmail($token)
    {
        if ($user = $this->users->findByConfirmationToken($token)) {
            $this->users->update($user->userid, [
                'status' => UserStatus::ACTIVE,
                'confirmation_token' => null
            ]);

            return redirect()->to('login')
                ->withSuccess(trans('app.email_confirmed_can_login'));
        }

        return redirect()->to('login')
            ->withErrors(trans('app.wrong_confirmation_token'));
    }
}
