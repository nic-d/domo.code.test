<?php

namespace App\Domain\Infrastructure\Providers;

use Laravel\Passport\Passport;
use App\Domain\Infrastructure\Support\Helpers\GateClassLoader;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     * @return void
     */
    public function boot() : void
    {
        $this->registerPolicies();
        Passport::routes();
    }

    /**
     * @return void
     */
    public function register() : void
    {
        GateClassLoader::registerGateClasses('infrastructure');
    }
}
