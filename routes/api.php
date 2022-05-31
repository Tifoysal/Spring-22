<?php

use App\Http\Controllers\API\ApiController;
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
Route::post('/login',[ApiController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout',[ApiController::class,'logout']);

    Route::get('/users',[ApiController::class,'getAllUsers']);
    Route::post('/user/create',[ApiController::class,'createUser']);
    Route::get('/user/view/{id}',[ApiController::class,'viewUser']);
});

