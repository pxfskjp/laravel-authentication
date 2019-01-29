<?php

namespace Tests\Feature;

use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    private $user;
    private $authenticatedUserIdUrl;

    public function setUp()
    {
        parent::setUp();
        $this->authenticatedUserIdUrl = route('user.authenticated');
        $this->user = factory(User::class)->create();
    }

    public function testGetUserIdByUnauthenticated()
    {
        $this->json('GET',
            $this->authenticatedUserIdUrl, [
                'Authorization' => 'fake_and_invalid_token'
            ])
            ->assertStatus(401)
            ->assertJsonStructure(['message']);
    }

    public function testGetUserIdByAuthenticated()
    {
        Passport::actingAs($this->user);
        $this->json('GET', $this->authenticatedUserIdUrl)
            ->assertStatus(200)
            ->assertJsonStructure([
                'token',
                'userId',
                'status',
                'code',
            ])
            ->json([
                'token' => $this->user->token(),
                'userId' => $this->user->id
            ]);
    }
}
