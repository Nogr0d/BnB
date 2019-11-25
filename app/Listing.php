<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Image;
use Carbon\CarbonPeriod;
class Listing extends Model
{
    protected $guarded=['id', 'user_id', 'amneties', 'image'];

    function amneties(){
        return $this->belongsToMany(Amnety::class);
    }
    function prices(){
        return $this->hasMany(Price::class);
    }
    function images(){
        return $this->hasMany(Image::class);
    }
    function reservations(){
        return $this->hasMany(Reservation::class);
    }
    function location(){
        return $this->belongsTo(Location::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function image(){
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

    function user(){
        return $this->belongsTo(User::class);
    }


    public function isMine(){
        $user=Auth::user();
        return $user&&$user->id==$this->user_id;
    }


    public function getPrice($start, $end){

        $period = CarbonPeriod::create($start, $end);
        $price=0;
        foreach ($period as $date) {

          $customPrice=Price::where('listing_id', $this->id)->where('start', '<=', $date)->whereDate('end', '>=', $date)->first();
          if($customPrice) $price+=$customPrice->price;
          else $price+=$this->price;

        }
        return $price;





        return $this->price;
    }



}
