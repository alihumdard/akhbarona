<?php

namespace App\Http\Controllers\Admin\Auth;

use Authy;
use App\Events\User\LoggedIn;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Social\SaveEmailRequest;
use App\Repositories\User\UserRepository;
use Auth;
use Session;
use Socialite;
use Laravel\Socialite\Contracts\User as SocialUser;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\Auth\Social\SocialManager;

class SocialAuthController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var SocialManager
     */
    private $socialManager;

    public function __construct(UserRepository $users, SocialManager $socialManager)
    {
        $this->middleware('guest');

        $this->users = $users;
        $this->socialManager = $socialManager;
    }

    /**
     * Redirect user to specified provider in order to complete the authentication process.
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        if (strtolower($provider) == 'facebook') {
            return Socialite::driver('facebook')->with(['auth_type' => 'rerequest'])->redirect();
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle response authentication provider.
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $socialUser = $this->getUserFromProvider($provider);

        $user = $this->users->findBySocialId($provider, $socialUser->getId());

        if (! $user) {

            // Only allow missing email from Twitter provider
            if (! $socialUser->getEmail()) {
                return redirect('login')->withErrors(trans('app.you_have_to_provide_email'));
            }

            $user = $this->socialManager->associate($socialUser, $provider);
        }

        return $this->loginAndRedirect($user);
    }

    /**
     * Get user from authentication provider.
     *
     * @param $provider
     * @return SocialUser
     */
    private function getUserFromProvider($provider)
    {
        return Socialite::driver($provider)->user();
    }

    /**
     * Log provided user in and redirect him to intended page.
     *
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginAndRedirect($user)
    {
        if ($user->isBanned()) {
            return redirect()->to('login')
                ->withErrors(trans('app.your_account_is_banned'));
        }

        Auth::login($user);

        event(new LoggedIn);

        return redirect()->intended('/');
    }
}
