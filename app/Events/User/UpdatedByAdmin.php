<?php

namespace App\Events\User;

use App\Models\User;

class UpdatedByAdmin
{
    /**
     * @var User
     */
    protected $updatedUser;

    public function __construct(User $updatedUser)
    {
        $this->updatedUser = $updatedUser;
    }

    /**
     * @return User
     */
    public function getUpdatedUser()
    {
        return $this->updatedUser;
    }
}
