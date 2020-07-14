<?php


namespace App\Http\Entities;


/**
 * @OA\Schema(
 *     description="Login request params entity",
 *     type="object",
 *     title="Login request data-entity",
 * )
 */
class LoginRequestEntity extends AbstractEntity
{
    /**
     * @OA\Property(
     *     title="Identity",
     *     description="User login or email",
     *     format="string",
     *     example="example@gmail.com"
     * )
     *
     * @var string
     */
    public string $login;

    /**
     * @OA\Property(
     *     title="Password",
     *     description="User password",
     *     format="string",
     *     example="qwerty123"
     * )
     *
     * @var string
     */
    public string $password;
}
