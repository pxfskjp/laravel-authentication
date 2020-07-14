<?php


namespace App\Http\Entities;

/**
 * @OA\Schema(
 *     description="Serious generic back-end error",
 *     type="object",
 *     title="Serious generic back-end error",
 * )
 */
class GenericBackendErrorEntity extends AbstractEntity
{
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
     *     example="Some serious error occurs during the data processing."
     * )
     *
     * @var string
     */
    public string $error;
}
