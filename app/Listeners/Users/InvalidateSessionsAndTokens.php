<?php

namespace App\Listeners\Users;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use App\Events\User\Banned;
use App\Events\User\LoggedIn;
use App\Repositories\Session\SessionRepository;
use App\Repositories\User\UserRepository;
use App\Services\Auth\Api\Token;

class InvalidateSessionsAndTokens
{
    /**
     * @var SessionRepository
     */
    private $sessions;

    public function __construct(SessionRepository $sessions)
    {
        $this->sessions = $sessions;
    }

    /**
     * Handle the event.
     *
     * @param Banned $event
     * @return void
     */
    public function handle(Banned $event)
    {
        $user = $event->getBannedUser();

        $this->sessions->invalidateAllSessionsForUser($user->id);

        Token::where('user_id', $user->id)->delete();
    }
}
