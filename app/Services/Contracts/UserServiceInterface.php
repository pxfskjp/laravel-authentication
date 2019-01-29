<?php
/**
 * Created by PhpStorm.
 * User: finatoros
 * Date: 29.01.19
 * Time: 16:14
 */

namespace App\Services\Contracts;


use Illuminate\Http\JsonResponse;

interface UserServiceInterface extends ServiceInterface
{
    public function getAuthenticatedUser(): array;
}