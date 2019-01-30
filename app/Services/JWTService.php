<?php


namespace App\Services;


use App\Services\Contracts\JWTServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

class JWTService implements JWTServiceInterface
{
    public function validateToken(): array
    {
        return [
            'status' => 'success', 'code' => 200
        ];
    }

    public function createTokenByCredentials(string $identity, string $password): Response
    {
        $tokenRequest = Request::create(
            config('app.url') . config('auth.passport.token.link'),
            'POST',
            [
                'grant_type' => config('auth.passport.grant'),
                'client_id' => config('auth.passport.client.id'),
                'client_secret' => config('auth.passport.client.secret'),
                'username' => $identity,
                'password' => $password,
                'scope' => '*'
            ]
        );
        app()->instance('request', $tokenRequest);
        return Route::dispatch($tokenRequest);
    }
}