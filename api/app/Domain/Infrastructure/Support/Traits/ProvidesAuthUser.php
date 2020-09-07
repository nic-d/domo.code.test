<?php

namespace App\Domain\Infrastructure\Support\Traits;

use App\Domain\Infrastructure\Models\User;

trait ProvidesAuthUser
{
    /**
     * @param string $guard
     * @return bool
     */
    public function hasAuthUser(string $guard = 'api') : bool
    {
        /** @var User|null $authUser */
        $authUser = auth()->guard($guard)->user();
        return $authUser instanceof User;
    }

    /**
     * @param string $guard
     * @return User|null
     */
    public function getAuthUser(string $guard = 'api') : ?User
    {
        return $this->hasAuthUser($guard) ? auth()->guard($guard)->user() : null;
    }
}
