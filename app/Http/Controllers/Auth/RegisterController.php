<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegistrationRequest;
use App\Http\Controllers\Controller;
use App\Services\Contracts\RegistrationServiceInterface;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{

    protected $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RegistrationServiceInterface $service)
    {
        $this->service = $service;
        $this->middleware('guest');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        $result = $this->service->register($request);
        return response()->json($result, $result['code']);
    }
}
