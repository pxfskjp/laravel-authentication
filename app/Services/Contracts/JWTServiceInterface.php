<?php


namespace App\Services\Contracts;


use Illuminate\Http\Response;

interface JWTServiceInterface
{
    public function validateToken(): array;

    public function createTokenByCredentials(string $identity, string $password): Response;
}