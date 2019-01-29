<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Contracts\AuthenticationServiceInterface;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $authenticationService;

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
     * Login user.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authenticationService->login($request);
        return response()->json($result, $result['code']);
    }

    /**
     * Logout user current user.
     *
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $result = $this->authenticationService->logout();
        return response()->json($result, $result['code']);
    }
}
