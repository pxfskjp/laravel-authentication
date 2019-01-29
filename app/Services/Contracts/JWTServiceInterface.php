<?php


namespace App\Services\Contracts;


interface JWTServiceInterface
{
    public function validateToken(): array;
}