<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body'
    ];

    public function chat(){
        return $this->belongsTo('App\Chat','chat_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
