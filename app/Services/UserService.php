<?php
/**
 * Created by PhpStorm.
 * User: finatoros
 * Date: 14.01.19
 * Time: 16:01
 */

namespace App\Services;


use App\Repositories\UserRepository;
use App\Services\Contracts\GenericService;

class UserService extends GenericService
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }
}