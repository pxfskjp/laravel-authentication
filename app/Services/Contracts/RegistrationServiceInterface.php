<?php
/**
 * Created by PhpStorm.
 * User: finatoros
 * Date: 15.01.19
 * Time: 19:06
 */

namespace App\Services\Contracts;


use App\Http\Entities\RegistrationResponseEntity;
use App\Http\Requests\RegistrationRequest;

/**
 * Interface RegistrationServiceInterface
 * @package App\Services\Contracts
 */
interface RegistrationServiceInterface
{
    /**
     * @param array $payload
     * @return RegistrationResponseEntity|null
     */
    public function register(array $payload): ?RegistrationResponseEntity;
}
