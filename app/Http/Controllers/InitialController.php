<?php

namespace App\Http\Controllers;


class InitialController extends Controller
{
    public function init(){
        return view()->make('welcome');
    }
}
