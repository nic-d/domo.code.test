<?php

namespace App\Domain\Infrastructure\Support\Traits;

use App\Domain\Infrastructure\Support\Helpers\Str;

trait Uuid
{
    /**
     * @return void
     */
    public static function bootUuid() : void
    {
        static::creating(static function ($model) {
            $model->uuid = Str::nanoId();
        });
    }
}
