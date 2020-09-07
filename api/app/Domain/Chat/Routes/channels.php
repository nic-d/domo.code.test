<?php

use Illuminate\Support\Facades\Broadcast;
use App\Domain\Infrastructure\Models\User;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('channel.{uuid}', function (User $user, $uuid) {
    return true;
});
