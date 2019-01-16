<?php

namespace App\Services;

use App\Repositories\Contracts\Repository;
use App\Services\Contracts\AuthenticationService;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginService implements AuthenticationService
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function login(LoginRequest $request): array
    {
        $identity = filter_var($request->input('identity'), FILTER_VALIDATE_EMAIL)
            ? 'email' : 'login';
        $credentials = [
            $identity => $request->user['identity'],
            'password' => Hash::make($request->user['password'])
        ];
        return auth()->attempt($credentials)
            ? ['token' => auth()->user()->createToken('AuthToken')->token,
                'userId' => auth()->user()->id,
                'status' => 'success',
                'code' => 200]
            : ['status' => 'error',
                'message' => 'Login error occurs!',
                'code' => 401];
    }

    public function logout(Request $request): array
    {

    }
}