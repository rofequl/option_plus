<?php

namespace App\Http\Controllers;

use App\country;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function Currency(Request $request)
    {
        $currency = country::where('id', $request->id)->pluck('currency_symbol')->first();
        echo $currency;
    }
}
