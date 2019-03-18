<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function Tracking(Request $request)
    {
        $value = substr($request->id,0,1);
        if($value == "S"){
            return '/supplier/'.$request->id;
        }elseif ($value == "C"){
            return '/customer/'.$request->id;
        }
        return '/supplier/'.$request->id;
    }
}
