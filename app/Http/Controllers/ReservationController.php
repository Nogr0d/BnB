<?php

namespace App\Http\Controllers;

use App\CustomNotification;
use App\Notifications\NewMessage;
use App\Notifications\NewReservation;
use App\Notifications\ReservationCanceled;
use App\Reservation;
use App\Message;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Srmklive\PayPal\Facades\PayPal;

class ReservationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');

        $notif_id=Input::get('notif');
        if($notif_id){
            $notif=CustomNotification::find($notif_id);
            if($notif){
                $notif->seen=1;
                $notif->save();
            }
        }
    }

    public function show($id){

        $reservation=Reservation::findOrFail($id);
        /* @var $reservation \App\Reservation */
        if($reservation->user_id!=Auth::user()->id) return $this->reportUserViolation('Pokušaj pregleda detalja tuđe rezervacije.');
        $paypalLink=$reservation->getPaymentLink();
        return view('reservations.details', compact(["reservation", "paypalLink"]));

    }
    public function index(){
        $user=Auth::user();
        $reservations=Reservation::with('listing')->where('user_id',$user->id)->get();
        return view('reservations.index', compact(["reservations"]));
    }

    public function guestlist(){
        $user=Auth::user();
        $reservations=Reservation::whereHas('listing',function($query) use ($user){
            $query->where('user_id', $user->id);
        } )->where('paid',1)->where('owner_reservation', 0)->orderBy('id', 'DESC')->get();
        return view('guestlist.index', compact(["reservations"]));
    }

    public function guestlistShow($id){
        $reservation=Reservation::withTrashed()->findOrFail($id);
        if($reservation->listing->user_id!=Auth::user()->id) return $this->reportUserViolation('Pokušaj pregleda detalja tuđe rezervacije.');
        return view('guestlist.details', compact(["reservation"]));

    }

    public function paypalCallback(){
       $provider=PayPal::setProvider('express_checkout');
       $response=$provider->getExpressCheckoutDetails(Input::get('token'));
       if(is_array($response)&&$response["ACK"]=="Success"){
           $reservation=Reservation::findOrFail($response["INVNUM"]);
           $reservation->paid=1;
           $reservation->save();
           //notif vlasniku
           $owner=$reservation->listing->user;
           $owner->notify(new NewReservation($reservation));
           return redirect(route("reservations.show", ["id"=>$reservation->id]))->with(Controller::SUCCESS_MESSAGE, "You have succesfully paid for this booking!");
       }
    }

    public function chat($id){
        request()->validate([
            "text"=>"required",

        ]);
        $reservation=Reservation::findOrFail($id);
        $user=Auth::user();
        if($reservation->user_id!=$user->id&&$reservation->listing->user_id!=$user->id) {
            return $this->reportUserViolation('Dodavanje u tuđi chat.');
        }

        if($reservation->paid==0){
            return $this->reportUserViolation('Chatanje prije naplate.');
        }
        $message=new Message();
        $message->text=Input::get('text');
        $message->user_id=$user->id;
        $message->reservation_id=$id;
        $message->save();

        $otherPerson=$reservation->user_id==$user->id?$reservation->listing->user:$reservation->user;
        $otherPerson->notify(new NewMessage($reservation));


        return redirect()->back()->with(Controller::SUCCESS_MESSAGE, "You have succesfully sent a message.");
    }

    public function cancel($id){
        $reservation=Reservation::findOrFail($id);
        if($reservation->user_id!=Auth::user()->id){
            return $this->reportUserViolation('Pokušaj cancela tuđe rezervacije.');
        }
        if($reservation->hasBegun()){
            return $this->reportUserViolation('Pokušaj cancela rezervacije koja je već počela.');

        }

        $owner=$reservation->listing->user;
        $owner->notify(new ReservationCanceled($reservation));
        $reservation->delete();
        return redirect(route('reservations.index'))->with(Controller::SUCCESS_MESSAGE, "You have succesfully canceled this booking.");

    }

}
