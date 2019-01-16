<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Contracts\AuthenticationService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $authenticationService;

    /**
     * Create a new controller instance.
     * @var AuthenticationService
     * @return void
     */
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login user .
     *
     * @param LoginRequest $request
     * @return integer
     */
    public function login(LoginRequest $request)
    {
        $result = $this->authenticationService->login($request);
        return response()->json($result, $result['code']);
    }

    /**
     * Logout user .
     *
     * @param LoginRequest $request
     * @return integer
     */
    public function logOff(Request $request)
    {
        return '';
    }
}
