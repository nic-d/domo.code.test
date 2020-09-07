<?php

namespace App\Domain\Chat\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot() : void
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map() : void
    {
        Route::prefix('chat')
            ->middleware(['api'])
            ->group(base_path('app/Domain/Chat/Routes/chat.php'))
        ;
    }
}
