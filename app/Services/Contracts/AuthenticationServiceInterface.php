<?php
/**
 * Created by PhpStorm.
 * User: finatoros
 * Date: 15.01.19
 * Time: 11:31
 */

namespace App\Services\Contracts;


use App\Http\Entities\LoginResponseEntity;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

/**
 * Interface AuthenticationServiceInterface
 * @package App\Services\Contracts
 */
interface AuthenticationServiceInterface
{
    /**
     * @param string $login
     * @param string $password
     * @return LoginResponseEntity|null
     */
    public function login(string $login, string $password): ?LoginResponseEntity;

    /**
     * @return array
     */
    public function logout(): array;
}
