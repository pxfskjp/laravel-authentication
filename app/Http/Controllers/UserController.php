<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUserId(): int
    {
        return json_encode(['authenticated' => Auth::user()->id]);
    }
}
