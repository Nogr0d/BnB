<?php

namespace App\Http\Controllers;

use App\Amnety;
use App\Listing;
use App\Location;
use App\Reservation;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ListingController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $listings=Listing::with(['image', 'location', 'amneties'])->where('user_id', Auth::user()->id)->get();
        return view('listing.my-listings', compact(["listings"]));
    }

    public function create()
    {
        $amneties=Amnety::all();
        $locations=Location::all();
        return view('listing.create', compact(["amneties", "locations"]));
    }

    public function store(){
        $data=request()->validate([
            'name'=>'required',
            'guests'=>'required',
            'location_id'=>'required',
            'description'=>'required',
            'bedrooms'=>'required',
            'beds'=>'required',
            'bathrooms'=>'required',
            'price'=>'required',
            'check_in_from'=>'required',
            'check_in_to'=>'required',
            'check_out'=>'required',
            'amneties'=>'array',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $user=Auth::user();
        $listing=new Listing;
        $listing->fill(Input::all());
        $listing->user_id=$user->id;
        $listing->visible=0; //Iako je to default u bazi, neka smo sigurni da nije vidljivo dok ne popuni galeriju, cijene, itd.
        $listing->save();
        //header image

        $request=request();
        // Get image file
        $image = $request->file('image');
        // Make a image name based on user name and current timestamp
        $name = "header";
        // Define folder path
        $folder = "/storage/listings/$listing->id/";
        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
        // Upload image
        $this->uploadOne($image, $folder, 'public', $name);
        // Set user profile image path in database to filePath

        $image=new Image;
        $image->listing_id=0; //da mi ne upada header u galeriju. mozda to nije ni lose?
        $image->title=$listing->name;
        $image->url=$filePath;
        $image->save();

        $listing->image_id=$image->id;
        $listing->save();




        $listing->amneties()->sync(Input::get('amneties'));
        return redirect(route("listing.details", ["id"=>$listing->id]))->with(Controller::SUCCESS_MESSAGE, 'You have succesfully added a new listing!');


    }
    public function details($id){
         $listing=Listing::findOrFail($id);
         if($listing->user_id!=Auth::user()->id){
             return $this->reportUserViolation('Pokušaj pregleda detalja tuđeg listinga.');
         }
         $reservations=Reservation::where('listing_id', $listing->id)->where('owner_reservation', 1)->get();

         return view('listing.details', compact(["listing", "reservations"]));
    }

    public function edit($id){
        $listing=Listing::findOrFail($id);
        if(!$listing->isMine()){
            return $this->reportUserViolation('Pokušaj edit forme tuđeg listinga.');
        }
        $locations=Location::all();
        $amneties=Amnety::all();
        return view('listing.edit', compact(["listing", "amneties", "locations"]));
    }
    public function update($id){
        $data=request()->validate([
            'name'=>'required',
            'guests'=>'required',
            'location_id'=>'required',
            'description'=>'required',
            'bedrooms'=>'required',
            'beds'=>'required',
            'bathrooms'=>'required',
            'price'=>'required',
            'check_in_from'=>'required',
            'check_in_to'=>'required',
            'check_out'=>'required',
            'amneties'=>'array',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $user=Auth::user();
        $listing=Listing::findOrFail($id);
        if(!$listing->isMine()) return $this->reportUserViolation('Pokušaj edita tuđeg listinga.');
        $listing->fill(Input::all());
        $listing->save();
        //header image

        $request=request();
        // Get image file
        $image = $request->file('image');
        if($image) {
            // Make a image name based on user name and current timestamp
            $name = "header";
            // Define folder path
            $folder = "/storage/listings/$listing->id/";
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath

            $image = new Image;
            $image->listing_id = 0; //da mi ne upada header u galeriju. mozda to nije ni lose?
            $image->title = $listing->name;
            $image->url = $filePath;
            $image->save();

            $listing->image_id = $image->id;
            $listing->save();
        }



        $listing->amneties()->sync(Input::get('amneties'));
        return redirect(route("listing.details", ["id"=>$listing->id]))->with(Controller::SUCCESS_MESSAGE, 'You have succesfully edited your listing!');


    }


    public function blockDates(){

            request()->validate([
                'start'=>'required|dateFormat:d.m.Y',
                'end'=>'required|dateFormat:d.m.Y|after:start',
                'listing_id'=>'required'
            ]);
            $listing=Listing::findOrFail(Input::get('listing_id'));
            if(!$listing->isMine()){
                return $this->reportUserViolation('Dodavanje blokiranja na tuđi listing!');
            }


            $reservation=new Reservation;
            $reservation->start=date("Y-m-d", strtotime(Input::get('start')));
            $reservation->end=date("Y-m-d", strtotime(Input::get('end')));
            $reservation->owner_reservation=1;
            $reservation->listing_id=Input::get('listing_id');
            $reservation->user_id=Auth::user()->id;
            $reservation->price=0;
            $reservation->paid=1;
            $reservation->save();
            return redirect()->back()->with(Controller::SUCCESS_MESSAGE, "You have succesfully blocked the selected dates.");


    }
    public function deleteBlockedDates($id){
        $reservation=Reservation::findOrFail($id);
        $listing=$reservation->listing;
        if(!$listing->isMine()||!$reservation->owner_reservation){
            return $this->reportUserViolation('Pokušaj brisanja tuđe rezervacije ili rezervacije koja nije vlastita (blokada datuma).');
        }
        $reservation->delete();
        return redirect()->back()->with(Controller::SUCCESS_MESSAGE, "You have succesfully unblocked the selected dates.");

    }

    public function toggle($id){
        $listing=Listing::findOrFail($id);
        if($listing->isMine()){
            $listing->visible=!$listing->visible;
            $listing->save();
            return redirect()->back()->with(Controller::SUCCESS_MESSAGE, "You have succesfully toggled the visiblity of your listing.");
        }
        else {
            return $this->reportUserViolation("Pokušaj togglea tuđeg listinga!");
        }
    }

}
