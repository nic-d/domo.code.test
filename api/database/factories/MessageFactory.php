<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Chat\Models\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'user_id' => '',
        'channel_id' => '',
        'message' => $faker->sentences(2),
    ];
});
