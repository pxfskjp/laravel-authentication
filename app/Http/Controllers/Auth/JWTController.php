<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Contracts\JWTServiceInterface;
use Illuminate\Http\Request;

class JWTController extends Controller
{
    protected $jwtService;

    public function __construct(JWTServiceInterface $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function validateToken(Request $request)
    {
        return response()
            ->json($this->jwtService
                ->validateToken()
            );
    }
}
