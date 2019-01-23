<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUserId(): JsonResponse
    {
        return response()->json(['authenticated' => Auth::user()->id]);
    }
}
