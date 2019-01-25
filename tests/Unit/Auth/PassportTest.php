<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PassportTest extends TestCase
{
    private $authenticatedUser;
    private $clientSecret;

    public function setUp()
    {
        parent::setUp();
        $this->authenticatedUser = factory(User::class)->create();
        $this->clientSecret = DB::table('oauth_clients')
            ->where('id', config('auth.passport.client.id'))
            ->first()
            ->secret;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetJWTByValidData()
    {
        $data = [
            'grant_type' => config('auth.passport.grant'),
            'client_id' => config('auth.passport.client.id'),
            'client_secret' => $this->clientSecret,
            'username' => $this->authenticatedUser->login,
            'password' => 'password',
            'scope' => '*'
        ];
        $this->json('POST','/oauth/token', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'token_type',
                'expires_in',
                'access_token',
                'refresh_token'
            ]);
    }

    public function testGetJWTByInvalidData()
    {
        $data = [
            'grant_type' => config('auth.passport.grant'),
            'client_id' => config('auth.passport.client.id'),
            'client_secret' => 'fake_client_secret_e.t.c.',
            'username' => $this->authenticatedUser->login,
            'password' => 'password',
            'scope' => '*'
        ];
        $this->json('POST','/oauth/token', $data)
            ->assertStatus(401)
            ->assertJsonStructure([
                'error',
                'message'
            ]);
    }

    public function testGetUserIdByUnauthenticated()
    {
        $authenticatedUserIdUrl = '/api/user/id';

        $this->json('GET',
            $authenticatedUserIdUrl, [
                'Authorization' => 'fake_and_invalid_token'
            ])
            ->assertStatus(401)
            ->assertJsonStructure(['message']);
    }

    public function testGetUserIdByAuthenticated()
    {
        $authenticatedUserIdUrl = '/api/user/id';

        Passport::actingAs($this->authenticatedUser);
        $this->json('GET', $authenticatedUserIdUrl)
            ->assertStatus(200)
            ->assertJsonStructure(['authenticated'])
            ->json(['authenticated' => $this->authenticatedUser->id]);
    }
}
