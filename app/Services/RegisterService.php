<?php

namespace App\Services;


use App\Http\Entities\RegistrationResponseEntity;
use App\Http\Requests\RegistrationRequest;
use App\Repositories\Contracts\RepositoryInterface;
use App\Services\Contracts\JWTServiceInterface;
use App\Services\Contracts\RegistrationServiceInterface;
use Illuminate\Support\Facades\Hash;

/**
 * Class RegisterService
 * @package App\Services
 */
class RegisterService implements RegistrationServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * RegisterService constructor.
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $payload
     * @return RegistrationResponseEntity|null
     */
    public function register(array $payload): ?RegistrationResponseEntity
    {
        $password = Hash::make($payload['password']);

        $params = [
            'login' => $payload['login'],
            'password' => $password,
            'email' => $payload['email'],
        ];

        $user = $this->repository
            ->create($params);

        if($user) {

            return new RegistrationResponseEntity([
                'token' => $user->createToken('JWT')->accessToken,
                'user_id' => $user->id,
                'status' => 'success',
            ]);
        }

        return null;
    }
}
