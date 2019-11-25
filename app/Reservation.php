<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    //

    use SoftDeletes;

    protected $fillable=["start", "end", "listing_id"];

    public function listing(){
        return $this->belongsTo(Listing::class);
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function review(){
        return $this->hasOne(Review::class);
    }



    public function getPaymentLink(){
        //spremili smo rezervaciju, sad paypal!
        if(!$this->id||$this->paid) return false; //nespremljene i vec placene rezervacije se ne mogu platiti!
        $start=Carbon::make($this->start);
        $end=Carbon::make($this->end);

        $days=abs($start->diffInDays($end));

        $provider = PayPal::setProvider('express_checkout');      // To use express checkout(used by default).



        $data = [];
        $data['items'] = [
            [
                'name' => $this->listing->name.", $days nights",
                'price' => $this->listing->getPrice($this->start, $this->end),
                'qty' => 1
            ]
        ];
        $data['invoice_id'] = $this->id;
        $data['invoice_description'] = "Booking no. #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('paypal');
        $data['cancel_url'] = route('reservations.show', ["id"=>$this->id]);

        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }
        $data['total'] = $total;

        $response = $provider->setExpressCheckout($data);

        $this->price=$total;
        $this->save();


        // This will redirect user to PayPal
        return $response['paypal_link'];


    }
    public function isOver(){
        return Carbon::make($this->end)->isPast();
    }
    public function hasBegun(){

        return Carbon::make($this->start)->diffInDays(Carbon::today())<=0;
    }
}
