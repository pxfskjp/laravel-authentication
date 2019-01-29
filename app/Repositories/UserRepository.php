<?php

namespace App\Repositories;


use App\Repositories\Contracts\AbstractRepository;
use App\User;

class UserRepository extends AbstractRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}