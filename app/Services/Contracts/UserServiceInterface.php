<?php


namespace App\Services\Contracts;



use App\Http\Entities\LoggedUserResponseEntity;

/**
 * Interface UserServiceInterface
 * @package App\Services\Contracts
 */
interface UserServiceInterface extends ServiceInterface
{
    /**
     * @return LoggedUserResponseEntity
     */
    public function getAuthenticatedUser(): LoggedUserResponseEntity;
}
