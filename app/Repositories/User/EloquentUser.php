<?php

namespace App\Repositories\User;

use App\Repositories\Role\RoleRepository;
use App\Models\Role;
use App\Services\Auth\Social\ManagesSocialAvatarSize;
use App\Services\Upload\UserAvatarManager;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\SQLiteConnection;
use Laravel\Socialite\Contracts\User as SocialUser;
use App\Support\Enum\UserStatus;

class EloquentUser implements UserRepository
{
    use ManagesSocialAvatarSize;

    /**
     * @var UserAvatarManager
     */
    private $avatarManager;
    /**
     * @var RoleRepository
     */
    private $roles;

    public function __construct(UserAvatarManager $avatarManager, RoleRepository $roles)
    {
        $this->avatarManager = $avatarManager;
        $this->roles = $roles;
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findByEmail($email,$isAdmin = true)
    {
        if($isAdmin == true) {
            return User::where('email', $email)->where('role_id','>',0)->first();
        } else {
            return User::where('email', $email)->where('role_id','=',0)->first();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function findBySocialId($provider, $providerId)
    {
        return User::leftJoin('social_logins', 'users.userid', '=', 'social_logins.user_id')
            ->select('users.*')
            ->where('social_logins.provider', $provider)
            ->where('social_logins.provider_id', $providerId)
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function findBySessionId($sessionId)
    {
        return User::leftJoin('sessions', 'users.userid', '=', 'sessions.user_id')
            ->select('users.*')
            ->where('sessions.id', $sessionId)
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        return User::create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function associateSocialAccountForUser($userId, $provider, SocialUser $user)
    {
        return DB::table('social_logins')->insert([
            'user_id' => $userId,
            'provider' => $provider,
            'provider_id' => $user->getId(),
            'avatar' => $this->getAvatarForProvider($provider, $user),
            'created_at' => Carbon::now()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = User::query()->where('role_id',0);

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', "like", "%{$search}%");
                $q->orWhere('email', 'like', "%{$search}%");
                $q->orWhere('first_name', 'like', "%{$search}%");
                $q->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $result = $query->orderBy('userid', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }
    function paginateAdmin($perPage, $search = null, $status = null)
    {
        $query = User::query()->where('role_id','>',0);

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', "like", "%{$search}%");
                $q->orWhere('email', 'like', "%{$search}%");
                $q->orWhere('first_name', 'like', "%{$search}%");
                $q->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $result = $query->orderBy('userid', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        if (isset($data['country_id']) && $data['country_id'] == 0) {
            $data['country_id'] = null;
        }
        $user = $this->find($id);
        $user->update($data);

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $user = $this->find($id);

        $this->avatarManager->deleteAvatarIfUploaded($user);

        return $user->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return User::count();
    }

    /**
     * {@inheritdoc}
     */
    public function newUsersCount()
    {
        return User::whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()])
            ->count();
    }

    /**
     * {@inheritdoc}
     */
    public function countByStatus($status)
    {
        return User::where('status', $status)->count();
    }

    /**
     * {@inheritdoc}
     */
    public function latest($count = 20)
    {
        return User::orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function countOfNewUsersPerMonth(Carbon $from, Carbon $to)
    {
        $result = User::whereBetween('created_at', [$from, $to])
            ->orderBy('created_at')
            ->get(['created_at'])
            ->groupBy(function ($user) {
                return $user->created_at->format("Y_n");
            });

        $counts = [];

        while ($from->lt($to)) {
            $key = $from->format("Y_n");

            $counts[$this->parseDate($key)] = count($result->get($key, []));

            $from->addMonth();
        }

        return $counts;
    }

    /**
     * Parse date from "Y_m" format to "{Month Name} {Year}" format.
     * @param $yearMonth
     * @return string
     */
    private function parseDate($yearMonth)
    {
        list($year, $month) = explode("_", $yearMonth);

        $month = trans("app.months.{$month}");

        return "{$month} {$year}";
    }

    /**
     * {@inheritdoc}
     */
    public function getUsersWithRole($roleName)
    {
        return Role::where('name', $roleName)
            ->first()
            ->users;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserSocialLogins($userId)
    {
        return DB::table('social_logins')
            ->where('user_id', $userId)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function setRole($userId, $roleId)
    {
        return $this->find($userId)->setRole($roleId);
    }

    /**
     * {@inheritdoc}
     */
    public function findByConfirmationToken($token)
    {
        return User::where('confirmation_token', $token)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function switchRolesForUsers($fromRoleId, $toRoleId)
    {
        return User::where('role_id', $fromRoleId)
            ->update(['role_id' => $toRoleId]);
    }

    public function search($searchQuery) {
        return User::query()->where('role_id','=',0)
            ->where('status', '=', UserStatus::ACTIVE)
            ->where(function($q) use ($searchQuery) {
                $q->where('first_name','LIKE','%'.$searchQuery.'%');
                $q->orWhere('last_name', 'LIKE', '%'.$searchQuery.'%');
                $q->orWhere('username', 'LIKE', '%'.$searchQuery.'%');
                $q->orWhere('email', 'LIKE', '%'.$searchQuery.'%');
            })
            ->limit(20)
            ->get();
    }

    /**
     * @Auth Bang Truong Dinh
     * @Date 14/04/2019
     * @param $username
     */
    public function getByUserName($username) {
        return User::where('username',$username)->first();
    }
    public function designer()
    {
        $role = Role::where('name','like','%design%')->first();
        if($role) {
            return User::where('role_id',$role->id)->orderBy('first_name','ASC')->get();
        }
        return [];
    }
}
