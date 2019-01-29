<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface;
use App\Services\Contracts\AuthenticationServiceInterface;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class LoginService implements AuthenticationServiceInterface
{
    protected $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function login(LoginRequest $request)
    {
        $passportResponse = $this->getToken($request);
        $responseContent = json_decode($passportResponse->getContent(), true);
        return !isset($responseContent['error']) && $passportResponse->status() === 200
            ? ['token' => $responseContent['access_token'],
                'userId' => $this->getAuthenticatedId($responseContent['access_token']),
                'status' => 'success',
                'code' => 200]
            : ['status' => 'error',
                'error' => $responseContent['message'],
                'code' => 401];
    }

    private function getToken($request)
    {
        $tokenRequest = Request::create(
            config('app.url') . config('auth.passport.token.link'),
            'POST',
            [
                'grant_type' => config('auth.passport.grant'),
                'client_id' => config('auth.passport.client.id'),
                'client_secret' => config('auth.passport.client.secret'),
                'username' => $request->user['identity'],
                'password' => $request->user['password'],
                'scope' => '*'
            ]
        );
        app()->instance('request', $tokenRequest);
        return Route::dispatch($tokenRequest);
    }

    private function getAuthenticatedId($token): int
    {
        $request =  Request::create(config('app.url') . '/api/user/id','GET');
        $request->headers->set('Accept', 'application/json');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        app()->instance('request', $request);
        return Route::dispatch($request)->getData()->authenticated;
    }

    public function logout(): array
    {
        return auth()->user()->token()->revoke()
            ? ['status' => 'success','code' => 200]
            : ['status' => 'error',
                'error' => 'Logout unsuccessful. Try again later.',
                'code' => 400];
    }
}