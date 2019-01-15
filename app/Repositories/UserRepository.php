<?php
/**
 * Created by PhpStorm.
 * User: finatoros
 * Date: 15.01.19
 * Time: 10:07
 */

namespace App\Repositories;


use App\Repositories\Contracts\GenericRepository;
use App\User;

class UserRepository extends GenericRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}