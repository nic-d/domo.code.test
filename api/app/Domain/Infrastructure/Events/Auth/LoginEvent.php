<?php

namespace App\Domain\Infrastructure\Events\Auth;

use Illuminate\Http\Request;
use App\Domain\Infrastructure\Models\User;
use App\Domain\Infrastructure\Events\Event;

class LoginEvent extends Event
{
    public Request $request;
    public User $user;

    /**
     * LoginEvent constructor.
     * @param Request $request
     * @param User $user
     */
    public function __construct(Request $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }
}
