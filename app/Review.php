<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    function reservation(){
        return $this->belongsTo(Reservation::class);
    }



}
