<?php

use Illuminate\Http\Request;


Route::post('/users/login', 'Auth\LoginController@login')
    ->name('user.login');
Route::post('/users', 'Auth\RegisterController@register')
    ->name('user.register');

Route::middleware('auth:api')->group(function () {
    Route::get('/user/id', 'UserController@getUserId');
    Route::get('/logout', 'Auth\LoginController@logout');
});


