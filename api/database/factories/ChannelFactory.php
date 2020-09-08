<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Chat\Models\Channel;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});
