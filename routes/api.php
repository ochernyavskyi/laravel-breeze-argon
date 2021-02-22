<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'auth:api'], function () {
    Route::middleware('auth:api')->get('/userlist', [\App\Http\Controllers\Api\UserController::class, 'index']);
    Route::middleware('auth:api')->post('/create', [\App\Http\Controllers\Api\UserController::class, 'create']);
    Route::middleware('auth:api')->get('/user/delete/{user}', [\App\Http\Controllers\Api\UserController::class, 'delete']);
    Route::middleware('auth:api')->post('/update/{user}', [\App\Http\Controllers\Api\UserController::class, 'update']);
});
