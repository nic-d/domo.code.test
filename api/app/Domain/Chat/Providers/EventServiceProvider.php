<?php

namespace App\Domain\Chat\Providers;

use App\Domain\Chat\Events;
use App\Domain\Chat\Listeners;
use App\Domain\Infrastructure\Events as InfrastructureEvents;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        InfrastructureEvents\Auth\RegisterEvent::class => [
            Listeners\Register\CreateDefaultChannels::class,
        ],

        Events\Message\CreateEvent::class => [

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
