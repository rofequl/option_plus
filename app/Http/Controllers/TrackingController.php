<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function Tracking(Request $request)
    {
        $value = substr($request->id,0,1);
        if($value == "S"){

        }elseif (){

        }
        return '/supplier/'.$request->id;
    }
}
