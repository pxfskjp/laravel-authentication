<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Str;
use Tests\TestCase;


class RegistrationRequestTest extends TestCase
{
    use PrepareValidator;


    private $registerUserUrl;


    public function setUp()
    {
        parent::setUp();
        $this->validationRules = (new RegistrationRequest())->rules();
        $this->registerUserUrl = route('user.register');
    }

    public function testLoginRule()
    {
        $this->assertFalse(
            $this->validateField('user.login', 'an')
        );
        $this->assertFalse(
            $this->validateField('user.login', Str::random(61))
        );
    }

    public function testEmailRule()
    {
        $this->assertFalse(
            $this->validateField('user.email', 'andrew111')
        );
        $this->assertFalse(
            $this->validateField('user.email', 'andrew111@com')
        );
    }

    public function testPasswordRule()
    {
        $this->assertFalse(
            $this->validateField('user.password', 'newpa')
        );
        $this->assertFalse(
            $this->validateField('user.password', Str::random(37))
        );
    }

    public function testInvalidLogin()
    {
        $invalidLogins = ['', 'ww', Str::random(61)];

        foreach ($invalidLogins as $login) {
            $data = [
                'user' => [
                    'login' => $login,
                    'email' => 'test@gmail.com',
                    'password' => 'testoidnov',
                    'password_confirmation' => 'testoidnov'
                ]
            ];
            $this->json('POST', $this->registerUserUrl, $data)
                ->assertStatus(422)
                ->assertJsonStructure([
                    'message',
                    'errors' => [
                        'user.login'
                    ]
                ]);
        }
    }

    public function testInvalidEmail()
    {
        $invalidEmails = ['paul.castellano@.com', 'tommybilotty@', 'cosanostramail.com'];

        foreach ($invalidEmails as $email) {
            $data = [
                'user' => [
                    'login' => 'gambinoboss',
                    'email' => $email,
                    'password' => 'testoidnov',
                    'password_confirmation' => 'testoidnov'
                ]
            ];
            $this->json('POST', $this->registerUserUrl, $data)
                ->assertStatus(422)
                ->assertJsonStructure([
                    'message',
                    'errors' => [
                        'user.email'
                    ]
                ]);
        }
    }

    public function testInvalidPassword()
    {
        $invalidPasswords = [
            '', 'qwerty', Str::random(37)
        ];

        foreach ($invalidPasswords as $password) {
            $data = [
                'user' => [
                    'login' => 'gambinoboss',
                    'email' => 'johngotti@mob.com',
                    'password' => $password,
                    'password_confirmation' => $password
                ]
            ];
            $this->json('POST', $this->registerUserUrl, $data)
                ->assertStatus(422)
                ->assertJsonStructure([
                    'message',
                    'errors' => [
                        'user.password'
                    ]
                ]);
        }
    }

    public function testInvalidPasswordConfirmation()
    {
        $invalidConrimationPasswords = [
            'johngottijunior', 'gotti', 'johngottijunior111',
            'junior111gunboomboom'
        ];

        foreach ($invalidConrimationPasswords as $password) {
            $data = [
                'user' => [
                    'login' => 'gambinoboss',
                    'email' => 'johngotti@cosanostra.com',
                    'password' => 'johngottijunior111gunboomboom',
                    'password_confirmation' => $password
                ]
            ];
            $this->json('POST', $this->registerUserUrl, $data)
                ->assertStatus(422)
                ->assertJsonStructure([
                    'message',
                    'errors' => [
                        'user.password'
                    ]
                ]);
        }
    }
}
