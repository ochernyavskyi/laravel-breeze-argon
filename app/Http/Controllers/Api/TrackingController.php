<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\User;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Sodium\increment;

class TrackingController extends Controller
{
    protected function index(Request $request)
    {

        Tracking::updateOrCreate(
            ['user_id' => Auth::id(),
                'user_agent' => $request->server('HTTP_USER_AGENT'),
                'ip' => $_SERVER["REMOTE_ADDR"],
                'product' => $request['product'],
                'country' => $request['country']])->increment('counter');
    }

}
