<?php


namespace App\Http\Entities;

/**
 * @OA\Schema(
 *     description="Registration request params entity",
 *     type="object",
 *     title="Registration request data-entity",
 * )
 */
class RegistrationRequestEntity extends AbstractEntity
{
    /**
     * @OA\Property(
     *     title="User login nickname",
     *     description="User login nickname",
     *     format="string",
     *     example="zealot111"
     * )
     *
     * @var string
     */
    public string $login;

    /**
     * @OA\Property(
     *     title="User email",
     *     description="User email",
     *     format="string",
     *     example="zealot111@gmail.com"
     * )
     *
     * @var string
     */
    public string $email;

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
