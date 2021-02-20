<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::get('upgrade', function () {
        return view('pages.upgrade');
    })->name('upgrade');
    Route::get('map', function () {
        return view('pages.maps');
    })->name('map');
    Route::get('icons', function () {
        return view('pages.icons');
    })->name('icons');
    Route::get('table-list', function () {
        return view('pages.tables');
    })->name('table');
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::get('/github/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github.redirect');

Route::get('/github/callback', function () {
    $userGithub = Socialite::driver('github')->user();
    $user = \App\Models\User::firstOrCreate(
        [
            'email' => $userGithub->getEmail()
        ],
        [
            'name' => $userGithub->getName(),
            'email' => $userGithub->getEmail(),
            'password' => \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(25))
        ]);
    Auth::login($user);
    return redirect()->route('home');
});


Route::get('/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

Route::get('/google/callback', function () {
    $userGoogle = Socialite::driver('google')->user();
    $user = \App\Models\User::firstOrCreate(
        [
            'email' => $userGoogle->getEmail()
        ],
        [
            'name' => $userGoogle->getName(),
            'email' => $userGoogle->getEmail(),
            'password' => \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(25))
        ]);
    Auth::login($user);
    return redirect()->route('home');
});


