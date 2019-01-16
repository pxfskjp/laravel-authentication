<?php

use Illuminate\Http\Request;





    Route::post('/users/login', 'Auth\LoginController@login');
    Route::post('/users', 'Auth\RegisterController@register');

    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', 'Auth\LoginController@logOff');
    });
