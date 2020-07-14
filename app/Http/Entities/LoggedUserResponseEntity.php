<?php


namespace App\Http\Entities;

/**
 * @OA\Schema(
 *     description="Token validation endpoint response params",
 *     type="object",
 *     title="Token validation endpoint data-entity",
 * )
 */
class LoggedUserResponseEntity extends AbstractEntity
{
    /**
     * @OA\Property(
     *     title="JWT Token",
     *     description="JWT token for current logged user.",
     *     format="string",
     *     example="eyJ0eXYiOiJKV1QiLCJhbGciOiJEUzI1NiJ9.eyJpc3MiDfkodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU5NDU3NTQzNCwiZXhwIjoxNTk0NTc5MDM0LCJuYmYiOjE1OTQ1NzU0MzQsImp0aSI6IkdEYUh3OHlNUHE5bzBYbjIiLCJzdWIiOjEsInBydiI6IjM5YTA0OGMwNzg3ZDRkMjBjMTc3NWVlZjBlMjA5MjU0NmQ0YjQ0NzMifQ.eFQavYPbztSG9UJAw2v1Na9DK7cIeShlm6vPQ78uyaE"
     * )
     *
     * @var string
     */
    public string $token;

    /**
     * @OA\Property(
     *     title="Logged user id",
     *     description="Logged user id.",
     *     format="int64",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $user_id;
}
