<?php


namespace App\Services;


use App\Http\Entities\LoggedUserResponseEntity;
use App\Repositories\UserRepository;
use App\Services\Contracts\AbstractService;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends AbstractService implements UserServiceInterface
{
    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return LoggedUserResponseEntity
     */
    public function getAuthenticatedUser(): LoggedUserResponseEntity
    {
        return new LoggedUserResponseEntity([
            'user_id' => Auth::user()->id,
            'status' => 'success',
        ]);
    }
}
