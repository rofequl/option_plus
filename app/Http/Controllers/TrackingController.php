<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function Tracking(Request $request)
    {
        return '/supplier/'.$request->id;
    }
}
