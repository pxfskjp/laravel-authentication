<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userService;


    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function getAuthenticatedUser(): JsonResponse
    {
        $result = $this->userService->getAuthenticatedUser();
        return response()->json($result, $result['code']);
    }
}
