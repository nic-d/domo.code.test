<?php

namespace App\Domain\Infrastructure\Support\Helpers;

use Hidehalo\Nanoid\Client;
use Illuminate\Support\Str as LaravelStr;

class Str extends LaravelStr
{
    /**
     * @return string
     */
    public static function nanoId() : string
    {
        $alphabet = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $client = new Client();

        return $client->formattedId($alphabet, 20);
    }
}
