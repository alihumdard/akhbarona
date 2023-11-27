<?php

namespace App\Http\Controllers\Admin;

use App\Events\User\Banned;
use App\Events\User\Deleted;
use App\Events\User\TwoFactorDisabledByAdmin;
use App\Events\User\TwoFactorEnabledByAdmin;
use App\Events\User\UpdatedByAdmin;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EnableTwoFactorRequest;
use App\Http\Requests\User\UpdateDetailsRequest;
use App\Http\Requests\User\UpdateLoginDetailsRequest;
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
use Illuminate\Support\Facades\Input;

class AdminAccountController extends Controller
{

    /**
     * @var UserRepository
     */
    private $users,$roles;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users, RoleRepository $role)
    {
        $this->middleware('auth');
        $this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);
        $this->middleware('permission:users.manage');
        $this->users = $users;
        $this->roles = $role;
    }

    /**
     * Display paginated list of all users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = $this->users->paginateAdmin(
            $perPage = 20,
            $request->get('search'),
            $request->get('status')
        );
        $roles = $this->roles->lists()->toArray();
        $statuses = ['' => trans('app.all')] + UserStatus::lists();

        return view('admin.user-admin.list', compact('users', 'statuses','roles'));
    }


    /**
     * Displays user profile page.
     *
     * @param User $user
     * @param ActivityRepository $activities
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(User $user, ActivityRepository $activities)
    {
        $userActivities = $activities->getLatestActivitiesForUser($user->userid, 10);

        return view('admin.user-admin.view', compact('user', 'userActivities'));
    }

    /**
     * Displays form for creating a new user.
     *
     * @param RoleRepository $roleRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(RoleRepository $roleRepository)
    {
        $roles = $roleRepository->lists();
        $statuses = UserStatus::lists();

        return view('admin.user-admin.add', compact('roles', 'statuses'));
    }

    /**
     * Stores new user into the database.
     *
     * @param CreateUserRequest $request
     * @return mixed
     */
    public function store(CreateUserRequest $request)
    {
        // When user is created by administrator, we will set his
        // status to Active by default.
        $data = $request->all() + ['status' => UserStatus::ACTIVE];
        // Username should be updated only if it is provided.
        // So, if it is an empty string, then we just leave it as it is.
        if (trim($data['username']) == '') {
            $data['username'] = null;
        }


        $user = $this->users->create($data);

        return redirect()->route('user-admin.list')
            ->withSuccess(trans('app.user_created'));
    }

    /**
     * Displays edit user form.
     *
     * @param User $user
     * @param RoleRepository $roleRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user, RoleRepository $roleRepository)
    {
        $edit = true;
        $roles = $roleRepository->lists();
        $statuses = UserStatus::lists();

        return view(
            'admin.user-admin.edit',
            compact('edit', 'user', 'roles', 'statuses')
        );
    }

    /**
     * Updates user details.
     *
     * @param User $user
     * @param UpdateDetailsRequest $request
     * @return mixed
     */
    public function updateDetails(User $user, UpdateDetailsRequest $request)
    {
        $data = $request->all();


        $this->users->update($user->userid, $data);
        $this->users->setRole($user->userid, $request->role_id);

        event(new UpdatedByAdmin($user));

        // If user status was updated to "Banned",
        // fire the appropriate event.
        if ($this->userIsBanned($user, $request)) {
            event(new Banned($user));
        }

        return redirect()->back()
            ->withSuccess(trans('app.user_updated'));
    }

    /**
     * Check if user is banned during last update.
     *
     * @param User $user
     * @param Request $request
     * @return bool
     */
    private function userIsBanned(User $user, Request $request)
    {
        return $user->status != $request->status && $request->status == UserStatus::BANNED;
    }

    /**
     * Update user's avatar from uploaded image.
     *
     * @param User $user
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatar(User $user, UserAvatarManager $avatarManager, Request $request)
    {
        $this->validate($request, ['avatar' => 'image']);

        $name = $avatarManager->uploadAndCropAvatar(
            $user,
            $request->file('avatar'),
            $request->get('points')
        );

        if ($name) {
            $this->users->update($user->userid, ['avatar' => $name]);

            event(new UpdatedByAdmin($user));

            return redirect()->route('user-admin.edit', $user->userid)
                ->withSuccess(trans('app.avatar_changed'));
        }

        return redirect()->route('user-admin.edit', $user->userid)
            ->withErrors(trans('app.avatar_not_changed'));
    }

    /**
     * Update user's avatar from some external source (Gravatar, Facebook, Twitter...)
     *
     * @param User $user
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatarExternal(User $user, Request $request, UserAvatarManager $avatarManager)
    {
        $avatarManager->deleteAvatarIfUploaded($user);

        $this->users->update($user->userid, ['avatar' => $request->get('url')]);

        event(new UpdatedByAdmin($user));

        return redirect()->route('user-admin.edit', $user->userid)
            ->withSuccess(trans('app.avatar_changed'));
    }

    /**
     * Update user's login details.
     *
     * @param User $user
     * @param UpdateLoginDetailsRequest $request
     * @return mixed
     */
    public function updateLoginDetails(User $user, UpdateLoginDetailsRequest $request)
    {
        $data = $request->all();

        if (trim($data['password']) == '') {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        $this->users->update($user->userid, $data);

        event(new UpdatedByAdmin($user));

        return redirect()->route('user-admin.edit', $user->userid)
            ->withSuccess(trans('app.login_updated'));
    }

    /**
     * Removes the user from database.
     *
     * @param User $user
     * @return $this
     */
    public function delete(User $user)
    {
        if ($user->userid == \Illuminate\Support\Facades\Auth::user()->userid) {
            return redirect()->route('user-admin.list')
                ->withErrors(trans('app.you_cannot_delete_yourself'));
        }

        $this->users->delete($user->userid);

        event(new Deleted($user));

        return redirect()->route('user-admin.list')
            ->withSuccess(trans('app.user_deleted'));
    }

    /**
     * Enables Authy Two-Factor Authentication for user.
     *
     * @param User $user
     * @param EnableTwoFactorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enableTwoFactorAuth(User $user, EnableTwoFactorRequest $request)
    {
        if (Authy::isEnabled($user)) {
            return redirect()->route('user-admin.edit', $user->userid)
                ->withErrors(trans('app.2fa_already_enabled_user'));
        }

        $user->setAuthPhoneInformation($request->country_code, $request->phone_number);

        Authy::register($user);

        $user->save();

        event(new TwoFactorEnabledByAdmin($user));

        return redirect()->route('user-admin.edit', $user->userid)
            ->withSuccess(trans('app.2fa_enabled'));
    }

    /**
     * Disables Authy Two-Factor Authentication for user.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disableTwoFactorAuth(User $user)
    {
        if (! Authy::isEnabled($user)) {
            return redirect()->route('user-admin.edit', $user->userid)
                ->withErrors(trans('app.2fa_not_enabled_user'));
        }

        Authy::delete($user);

        $user->save();

        event(new TwoFactorDisabledByAdmin($user));

        return redirect()->route('user-admin.edit', $user->userid)
            ->withSuccess(trans('app.2fa_disabled'));
    }


    /**
     * Displays the list with all active sessions for selected user.
     *
     * @param User $user
     * @param SessionRepository $sessionRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sessions(User $user, SessionRepository $sessionRepository)
    {
        $adminView = true;
        $sessions = $sessionRepository->getUserSessions($user->userid);

        return view('admin.user-admin.sessions', compact('sessions', 'user', 'adminView'));
    }

    /**
     * Invalidate specified session for selected user.
     *
     * @param User $user
     * @param $session
     * @param SessionRepository $sessionRepository
     * @return mixed
     */
    public function invalidateSession(User $user, $session, SessionRepository $sessionRepository)
    {
        $sessionRepository->invalidateSession($session->id);

        return redirect()->route('user-admin.sessions', $user->userid)
            ->withSuccess(trans('app.session_invalidated'));
    }
}
