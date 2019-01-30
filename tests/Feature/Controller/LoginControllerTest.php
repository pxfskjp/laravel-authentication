<?php

namespace Tests\Feature\Controller;

use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    private $loginUser;
    private $loginUrl;
    private $logOutUrl;


    public function setUp()
    {
        parent::setUp();
        $this->loginUrl = route('user.login');
        $this->logOutUrl = route('user.logout');
        $this->loginUser = factory(User::class)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginInvalidCall()
    {
        $this->json('POST', $this->loginUrl)
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'user.identity',
                    'user.password'
                ]
            ]);
    }

    public function testLoginCorrectCall()
    {
        $this->json('POST', $this->loginUrl, [
            'user' => [
                'identity' => $this->loginUser->email,
                'password' => 'password'
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

    public function testSuccessLogout(){
        $user = Passport::actingAs($this->loginUser);
        $this->get($this->logOutUrl,[])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'code',
            ]);
    }
}
