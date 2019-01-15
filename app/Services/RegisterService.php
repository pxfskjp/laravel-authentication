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

class RegisterService implements RegistrationService
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }


    public function register(RegistrationRequest $request): array
    {
        $userId = $this->repository->create($request)->id;
        return $userId
            ? ['token' => auth()->user()->createToken('testingToken'),
                'userId' => $userId,
                'status' => 'success',
                'code' => 200]
            : ['status' => 'error',
                'message' => 'Registration error occurs!',
                'code' => 422];
    }
}