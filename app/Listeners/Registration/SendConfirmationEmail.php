<?php

namespace App\Listeners\Registration;

use App\Events\User\Registered;
use App\Notifications\EmailConfirmation;
use App\Repositories\User\UserRepository;

class SendConfirmationEmail
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
        $user = $event->getRegisteredUser();

        $token = str_random(60);
        $this->users->update($user->id, [
            'confirmation_token' => $token
        ]);

        $user->notify(new EmailConfirmation($token));
    }
}
