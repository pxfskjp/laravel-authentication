<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\APIController;
use App\Http\Requests\RegistrationRequest;
use App\Services\Contracts\RegistrationServiceInterface;
use Illuminate\Http\JsonResponse;

class RegisterController extends APIController
{

    protected RegistrationServiceInterface $service;

    /**
     * Create a new controller instance.
     *
     * @param RegistrationServiceInterface $service
     */
    public function __construct(RegistrationServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Post(
     *     path="/users/registration",
     *     operationId="registration",
     *     tags={"Authentication"},
     *     summary="New user registration.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RegistrationRequestEntity")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successfull registration.",
     *         @OA\JsonContent(
     *              ref="#/components/schemas/RegistrationResponseEntity"
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Some serious issue (with database / store) / server.",
     *         @OA\JsonContent(
     *              ref="#/components/schemas/GenericBackendErrorEntity"
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation error. Invalid parameters."
     *     )
     * )
     *
     * @param RegistrationRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $result = $this->service
            ->register($payload);

        if($result) {

            $response = $result;
            $status = 200;
        } else {
            $status = 400;
            $response = [
                'status' => 'error',
                'error' => 'Some serious error occurs during the registration process.',
                'code' => $status
            ];
        }

        return response()
            ->json($response, $status);
    }
}
