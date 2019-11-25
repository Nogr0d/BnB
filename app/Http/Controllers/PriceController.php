<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Listing;
use App\Price;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(){
        $data=request()->validate([
            'price'=>'required|numeric',
            'start'=>'required|dateFormat:d.m.Y',
            'end'=>'required|dateFormat:d.m.Y|after:start',
            'listing_id'=>'required'
        ]);
        $listing=Listing::findOrFail(Input::get('listing_id'));
        if($listing->user_id!=Auth::user()->id){
            return $this->reportUserViolation('Dodavanje cijene na tuđi listing!');
        }

        $price=new Price;
        $price->fill(Input::all());
        $price->start=date("Y-m-d", strtotime(Input::get('start')));
        $price->end=date("Y-m-d", strtotime(Input::get('end')));

        $price->save();
        return redirect()->back()->with(Controller::SUCCESS_MESSAGE, "You have succesfully added a new pricing period.");

    }
    public function delete($id){
        $price=Price::findOrFail($id);
        $listing=$price->listing;
        $user=Auth::user();
        if($listing->user_id!=$user->id){
            return $this->reportUserViolation('Pokušaj brisanja tuđe cijene.');
        }
        $price->delete();
        return redirect()->back()->with(Controller::SUCCESS_MESSAGE, "You have succesfully deleted the selected pricing period.");
    }

}
