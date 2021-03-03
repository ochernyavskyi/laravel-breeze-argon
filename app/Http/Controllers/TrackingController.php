<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {

        $trackings = Tracking::all();
        return view('tracking.index', compact('trackings'));
    }


    public function filter(Request $request){
        $trackings = Tracking::whereDate('created_at', $request['calendar'])->get();
        return view('tracking.index', compact('trackings'));
    }
}
