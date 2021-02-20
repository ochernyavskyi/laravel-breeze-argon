<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected function index()
    {
        return User::all();
    }

    protected function create(Request $request)
    {
        return User::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'api_token' => Str::random(60),
        ]);
    }

    protected function delete(User $user)
    {
        $user->delete();
    }

    protected function update(Request $request, User $user)
    {
        $user = User::find($user);
        $user->save($request->all());
    }

//    protected function update(Request $request)
//    {
//        $user = User::find($request['id']);
//        $user['email'] = $request['email'];
//        $user['name'] = $request['name'];
//        $user['password'] = Hash::make($request['password']);
//        $user->save();
//    }
}
