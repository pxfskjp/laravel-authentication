<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Passport::routes(function ($router) {
                $router->forAccessTokens();
                // Uncomment for allowing personal access tokens
                // $router->forPersonalAccessTokens();
                //$router->forTransientTokens();
        });

        /*
        Route::group([ 'middleware' => 'cors'], function() {
            Passport::routes(function ($router) {
                $router->forAccessTokens();
                // Uncomment for allowing personal access tokens
                // $router->forPersonalAccessTokens();
                //$router->forTransientTokens();
            });
        });
        */

        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}
