<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InitialController extends Controller
{
    public function init(){
        return view()->make('welcome');
    }
}
