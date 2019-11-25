<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    //
    use SoftDeletes;
    protected $fillable=["start", "end", "price", "listing_id"];

    public function listing(){
        return $this->belongsTo(Listing::class);
    }
}
