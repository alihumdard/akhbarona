<?php

namespace App\Listeners\Registration;

use App\Events\User\Registered;
use App\Notifications\UserRegistered;
use App\Repositories\User\UserRepository;

class SendSignUpNotification
{
    /**
     * @var UserRepository
     */
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        foreach ($this->users->getUsersWithRole('Admin') as $user) {
            $user->notify(new UserRegistered($event->getRegisteredUser()));
        }
    }
}
