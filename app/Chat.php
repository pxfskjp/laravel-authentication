<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function users(){
        return $this->hasMany('App\User');
    }
}
