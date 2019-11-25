<?php

namespace App\Http\Controllers;

use App\Notifications\NewReview;
use App\Reservation;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add($id){

        request()->validate(["text"=>"required",
            "stars"=>"required|min:1|max:5"]);
        $reservation=Reservation::findOrFail($id);
        $user=Auth::user();
        if($reservation->user_id!=$user->id) $this->reportUserViolation('Pokušaj reviewa tuđe rezervacije.');
        if($reservation->review) return $this->reportUserViolation('Pokušaj ponovnog reviewa.');
        if($reservation->paid==0) return $this->reportUserViolation('Pokušaj reviewa neplaćene rezervacije.');
        if(!$reservation->isOver()) return $this->reportUserViolation('Pokušaj reviewa prije isteka rezervacije.');
        $model=new Review();
        $model->reservation_id=$reservation->id;
        $model->text=Input::get('text');
        $model->stars=Input::get('stars');
        $model->listing_id=$reservation->listing_id;
        $owner=$reservation->listing->user;
        $owner->notify(new NewReview($reservation));

        $model->save();
        return redirect()->back()->with(Controller::SUCCESS_MESSAGE, "You have succesfully rated your stay here!");

    }
}
