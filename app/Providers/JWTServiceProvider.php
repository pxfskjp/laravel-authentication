<?php

namespace App\Providers;

use App\Services\JWTService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class JWTServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\JWTService', function (Application $app) {
            return new JWTService();
        });
        $this->app->bind(
            'App\Services\Contracts\JWTServiceInterface',
            'App\Services\JWTService'
        );
    }
}
