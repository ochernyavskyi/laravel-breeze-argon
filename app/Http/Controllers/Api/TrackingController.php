<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\TrackingApi;
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
        TrackingApi::dispatch($request->all(), $_SERVER);

    }

}
