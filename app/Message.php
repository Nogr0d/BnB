<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    //
    public function isMine(){
        $user=Auth::user();
        return $user&&$user->id==$this->user_id;
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
