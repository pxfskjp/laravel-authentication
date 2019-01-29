<?php

namespace App\Services;


use App\Http\Requests\RegistrationRequest;
use App\Repositories\Contracts\RepositoryInterface;
use App\Services\Contracts\RegistrationServiceInterface;
use Illuminate\Support\Facades\Hash;

class RegisterService implements RegistrationServiceInterface
{
    protected $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function register(RegistrationRequest $request): array
    {
        $user = $request->user;
        $user['password'] = Hash::make($user['password']);
        $user = $this->repository->create($user);
        return $user->id
            ? ['token' => $user->createToken('AuthToken')->token->id,
                'userId' => $user->id,
                'status' => 'success',
                'code' => 200]
            : ['status' => 'error',
                'message' => 'Registration error occurs!',
                'code' => 422];
    }
}