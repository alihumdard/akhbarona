<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
//use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Presenters\UserPresenter;
use App\Services\Auth\Api\TokenFactory;
use App\Services\Auth\TwoFactor\Authenticatable as TwoFactorAuthenticatable;
use App\Services\Auth\TwoFactor\Contracts\Authenticatable as TwoFactorAuthenticatableContract;
use App\Services\Logging\UserActivity\Activity;
use App\Support\Authorization\AuthorizationUserTrait;
use App\Support\Enum\UserStatus;
use Illuminate\Auth\Passwords\CanResetPassword;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements TwoFactorAuthenticatableContract
{
    use TwoFactorAuthenticatable,
        CanResetPassword,
        PresentableTrait,
        AuthorizationUserTrait,
        Notifiable;

    protected $presenter = UserPresenter::class;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $dates = ['last_login', 'birthday'];
    protected $primaryKey = 'userid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'username', 'first_name', 'last_name', 'phone', 'avatar',
        'address', 'country_id', 'birthday', 'last_login', 'confirmation_token', 'status',
        'remember_token', 'role_id','balance','type_register','postcode','city','state',''
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = trim($value) ?: null;
    }
    /**
     * Get full_name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function gravatar()
    {
        $hash = hash('md5', strtolower(trim($this->attributes['email'])));

        return sprintf("https://www.gravatar.com/avatar/%s?size=150", $hash);
    }

    public function isUnconfirmed()
    {
        return $this->status == UserStatus::UNCONFIRMED;
    }

    public function isActive()
    {
        return $this->status == UserStatus::ACTIVE;
    }
    public function isAdmin() {
        if($this->role_id > 0) {
            return true;
        }
        return false;
    }
    public function isSuperAdmin() {
        $role = $this->hasOne(Role::class,'id','role_id')->first();
        //dd($role);
        if($role && strpos(strtolower($role->name),'admin') !== false) {
            return true;
        }
        return false;
    }

    public function isBanned()
    {
        return $this->status == UserStatus::BANNED;
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->userid;
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        $token = app(TokenFactory::class)->forUser($this);

        return [
            'jti' => $token->id
        ];
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'user_in_team', 'user_id', 'team_id');
    }
    public function myteams() {
        return $this->hasMany(Team::class, 'user_id');
    }

    /**
     * Get joined user record associated with tournament.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    /**
     * Get avatar.
     *
     * @return string
     */
    public function getAvatarAttribute($value) {
        if($value) {
            if(filter_var($value, FILTER_VALIDATE_URL)){
                return $value;
            }
            return \Config::get('member.path_avatar').$this->userid.'/'.$value;
        }
        return '';
    }
}
