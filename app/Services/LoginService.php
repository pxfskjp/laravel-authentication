<?php

namespace App\Services;

use App\Repositories\Contracts\Repository;
use App\Services\Contracts\AuthenticationService;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class LoginService implements AuthenticationService
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function login(LoginRequest $request)
    {
        $passportResponse = $this->getTokenRequest($request);
        $responseContent = json_decode($passportResponse->getContent(), true);
        $this->getAuthenticatedId($responseContent['access_token']);
        return $passportResponse->status() === 200
            ? ['token' => $responseContent['access_token'],
                'userId' => 'test',
                'status' => 'success',
                'code' => 200]
            : ['status' => 'error',
                'error' => $responseContent['error'],
                'code' => 401];
    }

    private function getTokenRequest($request)
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

    private function getAuthenticatedId($token)
    {
        $request =  Request::create(config('app.url') . 'api/user/id','GET');
        $request->headers->set('Accept', 'application/json');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        app()->instance('request', $request);

        echo json_encode(Route::dispatch($request)->getContent());
        die();
        return Route::dispatch($request);

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