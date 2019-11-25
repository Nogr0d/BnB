<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{

    const SUCCESS_MESSAGE="flashMessageSuccess";
    const ERROR_MESSAGE="flashMessageError";
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function reportUserViolation($msg){

        $user=Auth::user();
       $msg.=$user?" \n User ID: $user->id":"\n Not logged in.";
        $msg.="\n Route: ".request()->url()." \n Data: ".json_encode(Input::all());
        Log::error($msg);
        die("Neutorizirani pristup.");
    }
}
