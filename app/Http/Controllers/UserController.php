<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTokenValidationRequest;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\JsonResponse;

/**
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT"
 * )
 */
class UserController extends APIController
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Get(
     *     path="/token/validate",
     *     operationId="tokenValidation",
     *     tags={"JWT"},
     *     security = {{"bearerAuth": {}}},
     *     summary="Logged user token validation endpoint.",
     *     @OA\Response(
     *         response="200",
     *         description="Token is valid. View user info.",
     *         @OA\JsonContent(
     *              ref="#/components/schemas/LoggedUserResponseEntity"
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Token is not provided or invalid.",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     * @param UserTokenValidationRequest $request
     * @return JsonResponse
     */
    public function getAuthenticatedUser(UserTokenValidationRequest $request): JsonResponse
    {
        $result = $this->userService
            ->getAuthenticatedUser();

        return response()
            ->json($result, 200);
    }
}
