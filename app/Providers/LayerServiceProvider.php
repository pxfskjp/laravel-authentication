<?php

namespace App\Providers;

use App\Services\LoginService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class LayerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\LoginService', function (Application $app) {
            return new LoginService(
                $app->make('App\Repositories\UserRepository')
            );
        });
        $this->app->bind(
            'App\Services\Contracts\AuthenticationService',
            'App\Services\LoginService'
        );
    }
}
