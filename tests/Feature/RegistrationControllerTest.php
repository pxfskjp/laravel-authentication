<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegistrationControllerTest extends TestCase
{
    private $registerUrl = '/api/users';

    public function testInvalidRegister()
    {
        $this->json('POST', $this->registerUrl)
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'user.login',
                    'user.email',
                    'user.password'
                ]
            ]);
    }

    public function testValidRegister()
    {
        $this->json('POST', $this->registerUrl, [
            'user' => [
                'login' => 'newlogin',
                'email' => 'newemail@gmail.com',
                'password' => 'password',
                'password_confirmation' => 'password'
            ]
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'token',
                'userId',
                'status',
                'code',
            ]);
    }
}
