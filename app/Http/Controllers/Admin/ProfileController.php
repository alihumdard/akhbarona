<?php

namespace App\Http\Controllers\Admin;

use App\Events\User\ChangedAvatar;
use App\Events\User\TwoFactorDisabled;
use App\Events\User\TwoFactorEnabled;
use App\Events\User\UpdatedProfileDetails;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\EnableTwoFactorRequest;
use App\Http\Requests\User\UpdateProfileDetailsRequest;
use App\Http\Requests\User\UpdateProfileLoginDetailsRequest;
use App\Repositories\Activity\ActivityRepository;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Session\SessionRepository;
use App\Repositories\User\UserRepository;
use App\Services\Upload\UserAvatarManager;
use App\Support\Enum\UserStatus;
use App\Models\User;
use Auth;
use Authy;
use Illuminate\Http\Request;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * @var User
     */
    protected $theUser;
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);

        $this->users = $users;

        $this->middleware(function ($request, $next) {
            $this->theUser = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display user's profile page.
     *
     * @param RoleRepository $rolesRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(RoleRepository $rolesRepo)
    {
        $user = $this->theUser;
        $edit = true;
        $roles = $rolesRepo->lists();
        $statuses = UserStatus::lists();

        return view(
            'admin.user-admin/profile',
            compact('user', 'edit', 'roles', 'statuses')
        );
    }

    /**
     * Update profile details.
     *
     * @param UpdateProfileDetailsRequest $request
     * @return mixed
     */
    public function updateDetails(UpdateProfileDetailsRequest $request)
    {
        $this->users->update($this->theUser->userid, $request->except('role_id', 'status'));

        event(new UpdatedProfileDetails);

        return redirect()->back()
            ->withSuccess(trans('app.profile_updated_successfully'));
    }

    /**
     * Upload and update user's avatar.
     *
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatar(Request $request, UserAvatarManager $avatarManager)
    {
        $this->validate($request, [
            'avatar' => 'image'
        ]);

        $name = $avatarManager->uploadAndCropAvatar(
            $this->theUser,
            $request->file('avatar'),
            $request->get('points')
        );

        if ($name) {
            return $this->handleAvatarUpdate($name);
        }

        return redirect()->route('profile')
            ->withErrors(trans('app.avatar_not_changed'));
    }

    /**
     * Update avatar for currently logged in user
     * and fire appropriate event.
     *
     * @param $avatar
     * @return mixed
     */
    private function handleAvatarUpdate($avatar)
    {
        $this->users->update($this->theUser->userid, ['avatar' => $avatar]);

        event(new ChangedAvatar);

        return redirect()->route('profile')
            ->withSuccess(trans('app.avatar_changed'));
    }

    /**
     * Update user's avatar from external location/url.
     *
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatarExternal(Request $request, UserAvatarManager $avatarManager)
    {
        $avatarManager->deleteAvatarIfUploaded($this->theUser);

        return $this->handleAvatarUpdate($request->get('url'));
    }

    /**
     * Update user's login details.
     *
     * @param UpdateProfileLoginDetailsRequest $request
     * @return mixed
     */
    public function updateLoginDetails(UpdateProfileLoginDetailsRequest $request)
    {
        $data = $request->except('role', 'status');

        // If password is not provided, then we will
        // just remove it from $data array and do not change it
        if (trim($data['password']) == '') {
            unset($data['password']);

            unset($data['password_confirmation']);
        }
        $this->users->update($this->theUser->userid, $data);

        return redirect()->route('profile')
            ->withSuccess(trans('app.login_updated'));
    }

    /**
     * Enable 2FA for currently logged user.
     *
     * @param EnableTwoFactorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enableTwoFactorAuth(EnableTwoFactorRequest $request)
    {
        if (Authy::isEnabled($this->theUser)) {
            return redirect()->route('user.edit', $this->theUser->userid)
                ->withErrors(trans('app.2fa_already_enabled'));
        }

        $this->theUser->setAuthPhoneInformation($request->country_code, $request->phone_number);

        Authy::register($this->theUser);

        $this->theUser->save();

        event(new TwoFactorEnabled);

        return redirect()->route('profile')
            ->withSuccess(trans('app.2fa_enabled'));
    }

    /**
     * Disable 2FA for currently logged user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disableTwoFactorAuth()
    {
        if (! Authy::isEnabled($this->theUser)) {
            return redirect()->route('profile')
                ->withErrors(trans('app.2fa_not_enabled_for_this_user'));
        }

        Authy::delete($this->theUser);

        $this->theUser->save();

        event(new TwoFactorDisabled);

        return redirect()->route('profile')
            ->withSuccess(trans('app.2fa_disabled'));
    }

    /**
     * Display user activity log.
     *
     * @param ActivityRepository $activitiesRepo
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activity(ActivityRepository $activitiesRepo, Request $request)
    {
        $user = $this->theUser;

        $activities = $activitiesRepo->paginateActivitiesForUser(
            $user->userid,
            $perPage = 20,
            $request->get('search')
        );

        return view('admin.activity.index', compact('activities', 'user'));
    }


    /**
     * Display active sessions for current user.
     *
     * @param SessionRepository $sessionRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sessions(SessionRepository $sessionRepository)
    {
        $profile = true;
        $user = $this->theUser;
        $sessions = $sessionRepository->getUserSessions($user->userid);

        return view('admin.user.sessions', compact('sessions', 'user', 'profile'));
    }

    /**
     * Invalidate user's session.
     *
     * @param $session \stdClass Session object.
     * @param SessionRepository $sessionRepository
     * @return mixed
     */
    public function invalidateSession($session, SessionRepository $sessionRepository)
    {
        $sessionRepository->invalidateSession($session->id);

        return redirect()->route('profile.sessions')
            ->withSuccess(trans('app.session_invalidated'));
    }
}
