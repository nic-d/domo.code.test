<?php

namespace App\Domain\Chat\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void
    {
        require base_path('app/Domain/Chat/Routes/channels.php');
    }
}
