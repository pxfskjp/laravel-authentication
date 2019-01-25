<?php

namespace Tests\Unit;

use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Str;
use Tests\TestCase;


class RegistrationRequestTest extends TestCase
{
    private $rules;
    private $validator;

    public function setUp()
    {
        parent::setUp();
        $this->rules = (new RegistrationRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    public function validateLoginRule()
    {
        $this->assertTrue(
            $this->validateField('user.login', 'andrew111')
        );
        $this->assertFalse(
            $this->validateField('user.login', 'an')
        );
        $this->assertFalse(
            $this->validateField('user.login', 'a')
        );
    }

    public function validateEmailRule()
    {
        $this->assertTrue(
            $this->validateField('user.email', 'andrew111@gmail.com')
        );
        $this->assertFalse(
            $this->validateField('user.email', 'andrew111')
        );
        $this->assertFalse(
            $this->validateField('user.email', 'andrew111@com')
        );
    }

    public function validatePasswordRule()
    {
        $this->assertTrue(
            $this->validateField('user.password', 'newpassword')
        );
        $this->assertFalse(
            $this->validateField('user.password', 'newpa')
        );
        $this->assertFalse(
            $this->validateField('user.password', Str::random(37))
        );
    }

    public function testInvalidLogin()
    {
        $registerUserUrl = '/api/users';

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
            $this->json('POST', $registerUserUrl, $data)
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
        $registerUserUrl = '/api/users';

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
            $this->json('POST', $registerUserUrl, $data)
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
        $registerUserUrl = '/api/users';

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
            $this->json('POST', $registerUserUrl, $data)
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
        $registerUserUrl = '/api/users';

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
            $this->json('POST', $registerUserUrl, $data)
                ->assertStatus(422)
                ->assertJsonStructure([
                    'message',
                    'errors' => [
                        'user.password'
                    ]
                ]);
        }
    }

    private function getFieldValidator($field, $value)
    {
        return $this->validator->make(
            [$field => $value],
            [$field => $this->rules[$field]]
        );
    }

    private function validateField($field, $value)
    {
        return $this->getFieldValidator($field, $value)->passes();
    }
}
