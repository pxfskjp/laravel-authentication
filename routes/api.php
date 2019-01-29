<?php

use Illuminate\Http\Request;


Route::post('/users/login', 'Auth\LoginController@login')
    ->name('user.login');
Route::post('/users', 'Auth\RegisterController@register')
    ->name('user.register');

Route::middleware('auth:api')->group(function () {
    Route::get('/token/validate', 'UserController@getAuthenticatedUser')
        ->name('passport.token.validate');

    Route::get('/user', 'UserController@getAuthenticatedUser')
        ->name('user.authenticated');

    Route::get('/users/logout', 'Auth\LoginController@logout')
        ->name('user.logout');
});


