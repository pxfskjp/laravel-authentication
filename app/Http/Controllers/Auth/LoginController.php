<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\APIController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Services\Contracts\AuthenticationServiceInterface;
use Illuminate\Http\JsonResponse;

class LoginController extends APIController
{
    protected AuthenticationServiceInterface $authenticationService;

    /**
     * Create a new controller instance.
     * @var AuthenticationServiceInterface
     * @return void
     */
    public function __construct(AuthenticationServiceInterface $authenticationService)
    {
        $this->authenticationService = $authenticationService;

        $this->middleware('guest')->except('logout');
    }

    /**
     * @OA\Post(
     *     path="/users/login",
     *     operationId="login",
     *     tags={"Authentication"},
     *     summary="User authentication endpoint to receive auth token.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequestEntity")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successfull authorization.",
     *         @OA\JsonContent(
     *              ref="#/components/schemas/LoginResponseEntity"
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="User credentials is invalid or user not found.",
     *         @OA\JsonContent(
     *              ref="#/components/schemas/LoginUnauthorizedErrorEntity"
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation error. Invalid parameters."
     *     )
     * )
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $payload = $request->validated();

        $result = $this->authenticationService
            ->login($payload['login'], $payload['password']);

        if($result) {

            $response = $result;
            $status = 200;
        } else {
            $status = 401;
            $response = [
                'status' => 'error',
                'error' => 'User credentials is invalid or user not found! Try again.',
                'code' => $status
            ];
        }

        return response()
            ->json($response, $status);
    }

    /**
     * Logout user current user.
     *
     * @param LogoutRequest $request
     * @return JsonResponse
     */
    public function logout(LogoutRequest $request): JsonResponse
    {
        $result = $this->authenticationService
            ->logout();

        return response()->json($result, $result['code']);
    }
}
