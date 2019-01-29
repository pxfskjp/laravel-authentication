<?php


namespace App\Services\Contracts;



interface UserServiceInterface extends ServiceInterface
{
    public function getAuthenticatedUser(): array;
}