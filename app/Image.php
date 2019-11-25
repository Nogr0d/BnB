<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //

    function listing(){
        return $this->belongsTo(Listing::class);
    }

    public function getPublicURL(){
        return env('APP_URL').$this->url;
    }
    public function getThumbnailURL(){

        return $this->getPublicURL();
    }
}
