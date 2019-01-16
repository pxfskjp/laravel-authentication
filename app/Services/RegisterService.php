<?php
/**
 * Created by PhpStorm.
 * User: finatoros
 * Date: 14.01.19
 * Time: 15:58
 */

namespace App\Services;


use App\Http\Requests\RegistrationRequest;
use App\Repositories\Contracts\Repository;
use App\Services\Contracts\RegistrationService;
use Illuminate\Support\Facades\Hash;

class RegisterService implements RegistrationService
{
    protected $repository;

    public function __construct(Repository $repository)
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