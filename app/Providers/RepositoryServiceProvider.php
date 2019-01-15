<?php

namespace App\Providers;

use App\Repositories\Contracts\Repository;
use App\Repositories\UserRepository;
use App\Services\Contracts\RegistrationService;
use App\Services\LoginService;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->singleton('App\Repositories\UserRepository', function (Application $app) {
            return new UserRepository(
                $app->make(User::class)
            );
        });

        $this->app->when(LoginService::class)
            ->needs(Repository::class)
            ->give('App\Repositories\UserRepository');

        $this->app->when(RegistrationService::class)
            ->needs(Repository::class)
            ->give('App\Repositories\UserRepository');
    }
}
