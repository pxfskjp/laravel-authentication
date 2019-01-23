<?php

namespace App\Providers;

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
        });
        Passport::tokensExpireIn(now()->addDays(config('auth.passport.token.expire')));
        Passport::refreshTokensExpireIn(now()->addDays(config('auth.passport.token.refresh')));
    }
}
