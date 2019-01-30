<?php

namespace App\Services;

use App\Services\Contracts\AuthenticationServiceInterface;
use App\Http\Requests\LoginRequest;


class LoginService implements AuthenticationServiceInterface
{
    public function login(LoginRequest $request): array
    {
        $identity = filter_var($request->user['identity'], FILTER_VALIDATE_EMAIL)
            ? 'email' : 'login';
        $credentials = [
            $identity => $request->user['identity'],
            'password' => $request->user['password']
        ];
        return auth()->attempt($credentials)
            ? [
                'token' => auth()->user()->createToken('JWT')->accessToken,
                'userId' => auth()->user()->id,
                'status' => 'success',
                'code' => 200]
            : ['status' => 'error',
                'error' => 'User credentials is invalid or user not found! Try again.',
                'code' => 401];
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