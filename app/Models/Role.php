<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Authorization\AuthorizationRoleTrait;

class Role extends Model
{
    use AuthorizationRoleTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    protected $casts = [
        'removable' => 'boolean'
    ];

    protected $fillable = ['name', 'display_name', 'description'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
