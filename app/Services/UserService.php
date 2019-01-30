<?php


namespace App\Services;


use App\Repositories\UserRepository;
use App\Services\Contracts\AbstractService;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Auth;

class UserService extends AbstractService implements UserServiceInterface
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getAuthenticatedUser(): array
    {
        return [
            'userId' => Auth::user()->id,
            'status' => 'success',
            'code' => 200
        ];
    }
}