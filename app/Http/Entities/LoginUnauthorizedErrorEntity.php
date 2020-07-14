<?php


namespace App\Http\Entities;

/**
 * @OA\Schema(
 *     description="Login request params entity",
 *     type="object",
 *     title="Login request data-entity",
 * )
 */
class LoginUnauthorizedErrorEntity extends AbstractEntity
{
    /**
     * @OA\Property(
     *     title="Error code",
     *     description="Error code",
     *     format="string",
     *     example=401
     * )
     *
     * @var int
     */
    public int $code;

    /**
     * @OA\Property(
     *     title="Error status type",
     *     description="Error str status",
     *     format="string",
     *     example="error"
     * )
     *
     * @var string
     */
    public string $status;

    /**
     * @OA\Property(
     *     title="Error message",
     *     description="Error message",
     *     format="string",
     *     example="User credentials is invalid or user not found! Try again."
     * )
     *
     * @var string
     */
    public string $error;
}
