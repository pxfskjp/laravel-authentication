<?php


namespace App\Services;


use App\Services\Contracts\JWTServiceInterface;
use Illuminate\Http\Request;

class JWTService implements JWTServiceInterface
{
    public function validateToken(): array
    {
        return [
            'status' => 'success', 'code' => 200
        ];
    }
}