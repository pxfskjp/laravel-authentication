<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegistrationRequest;
use App\Http\Controllers\Controller;
use App\Services\Contracts\RegistrationService;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RegistrationService $service)
    {
        $this->service = $service;
        $this->middleware('guest');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param RegistrationRequest $request
     * @return void
     */
    public function register(RegistrationRequest $request)
    {
        $result = $this->service->register($request);
        return response()->json($result, $result['code']);

    }
}
