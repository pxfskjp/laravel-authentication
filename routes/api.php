<?php

use Illuminate\Http\Request;


Route::post('/users/login', 'Auth\LoginController@signIn');
Route::post('/users', 'Auth\RegisterController@signUp');

Route::middleware('auth:api')->group(function () {
    Route::get('/logout', 'Auth\LoginController@logOff');
});