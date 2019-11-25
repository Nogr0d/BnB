<?php

namespace App\Http\Controllers;

use App\Listing;
use App\Location;
use App\Message;
use App\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{

    public function index()
    {
        $locations=Location::all();
        return view('home', compact(['locations']));
    }
    public function search(){
        request()->validate([
            "location"=>"required",
            "people"=>"required",

        ]);
        $listings=Listing::with(["image", "amneties", "location"])->where('visible', true);

        $location=Input::get('location');
        if($location) $listings->where('location_id', $location);
        $guests=Input::get('people');
        if($guests) $listings->where('guests', '>=', $guests);

        $checkin=Input::get('checkin');
        $checkout=Input::get('checkout');
        if($checkin&&$checkout){
            $checkin=Carbon::make($checkin);
            $checkout=Carbon::make($checkout);
            $listings=$listings->whereDoesntHave('reservations', function($query)use ($checkin, $checkout) {
                $query->where('paid', 1)->whereDate("start", "<=", $checkout)->whereDate('end', '>=', $checkin);
            });
        }


        $listings=$listings->get();



        return view('search', compact(["listings"]));
    }

    public function showListing($id){
        $listing=Listing::findOrFail($id);
        if($listing->isMine()||$listing->visible) {
            $reservations = Reservation::where('listing_id', $listing->id)->where('paid', 1)->whereDate('end', '>=', Carbon::today())->get(["start", "end"]);
            return view('listing.show', compact(["listing", "reservations"]));
        }
        else abort(404);
    }
    public function bookNow($id)
    {

        $user=Auth::user();
        if(!$user) return redirect()->back()->with(Controller::ERROR_MESSAGE, "Please log in before making a reservation.");
        $listing = Listing::findOrFail($id);
        if ($listing->isMine()) die("This is your own listing!");
        request()->validate([
            "guests" => "numeric|min:1|max:$listing->guests",
            "message"=>"required"
        ]);
        $dates = Input::get('datefilter');
        $dates = explode(" - ", $dates);
        if (sizeof($dates) != 2) return redirect()->back()->with(Controller::ERROR_MESSAGE, "Invalid date range. Please choose a date range.");

        $end = Carbon::make($dates[1]);
        $start = Carbon::make($dates[0]);

        $reservations = Reservation::where('listing_id', $listing->id)->where('paid', 1)->whereDate("start", "<=", $end)->whereDate('end', '>=', $start)->first();


        if ($reservations) return redirect()->back()->with(Controller::ERROR_MESSAGE, "You have selected a date range that overlaps with an existing reservation!");

        $model = new Reservation;
        $model->start = $start->format('Y-m-d');
        $model->end = $end->format('Y-m-d');
        $model->owner_reservation = 0;
        $model->guests = Input::get('guests');
        $model->listing_id=$id;
        $model->user_id=$user->id;
        $model->price=0;
        $model->save();
        $msg=new Message();
        $msg->text=Input::get('message');
        $msg->user_id=$user->id;
        $msg->reservation_id=$model->id;
        $msg->save();



        return redirect(route('reservations.show', ["id"=>$model->id]));
    }

}
