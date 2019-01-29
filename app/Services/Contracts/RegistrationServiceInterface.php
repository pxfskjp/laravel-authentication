<?php
/**
 * Created by PhpStorm.
 * User: finatoros
 * Date: 15.01.19
 * Time: 19:06
 */

namespace App\Services\Contracts;


use App\Http\Requests\RegistrationRequest;

interface RegistrationServiceInterface
{
    public function register(RegistrationRequest $request): array;
}