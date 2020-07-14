<?php

namespace App\Services;

use App\Http\Entities\LoginResponseEntity;
use App\Services\Contracts\AuthenticationServiceInterface;


/**
 * Class LoginService
 * @package App\Services
 */
class LoginService implements AuthenticationServiceInterface
{
    /**
     * @param string $login
     * @param string $password
     * @return LoginResponseEntity|null
     */
    public function login(string $login, string $password): ?LoginResponseEntity
    {
        $identity = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'login';

        $credentials = [
            $identity => $login,
            'password' => $password
        ];

        $authResult = auth()->attempt($credentials);

        if($authResult) {

            $user = auth()->user();

            return new LoginResponseEntity([
                'token' => $user->createToken('JWT')->accessToken,
                'user_id' => $user->id,
            ]);
        }

        return null;
    }

    /**
     * @return array
     */
    public function logout(): array
    {
        return auth()->user()->token()->revoke()
            ? ['status' => 'success','code' => 200]
            : ['status' => 'error',
                'error' => 'Logout unsuccessful. Try again later.',
                'code' => 400];
    }
}
