<?php

namespace App\Http\Controllers;


use App\Image;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Listing;

class ImageController extends Controller
{

    use UploadTrait;
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store($id){
        $data=request()->validate([
            'title'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $listing=Listing::findOrFail($id);
        if(!$listing->isMine()){
            return $this->reportUserViolation('Dodavanje slike na tuđi listing!');
        }

        $request=request();
        // Get image file
        $image = $request->file('image');
        // Make a image name based on user name and current timestamp
        $name = str_slug($request->input('title')).'_'.time();
        // Define folder path
        $folder = "/listings/$listing->id/";
        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
        // Upload image
        $this->uploadOne($image, $folder, 'public', $name);
        // Set user profile image path in database to filePath

        $image=new Image;
        $image->listing_id=$listing->id;
        $image->title=Input::get('title');
        $image->url=$filePath;
        $image->save();


        return redirect()->back()->with(Controller::SUCCESS_MESSAGE, "You have succesfully added a new image.");

    }
    public function delete($id){
        $image=Image::findOrFail($id);
        $listing=$image->listing;
        if(!$listing->isMine()){
            return $this->reportUserViolation('Pokušaj brisanja tuđe slike.');
        }
        $image->delete();
        return redirect()->back()->with(Controller::SUCCESS_MESSAGE, "You have succesfully deleted the selected gallery image.");
    }

}
