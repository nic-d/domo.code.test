<?php

namespace App\Domain\Infrastructure\Providers;

use App\Domain\Infrastructure\Events;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Events\Auth\LoginEvent::class => [

        ],

        Events\Auth\RegisterEvent::class => [

        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot() : void
    {
        parent::boot();
    }
}
