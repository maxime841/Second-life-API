<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\HouseController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route crud land
Route::resource('/lands', LandController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

//Route afficher les photos selon le tag
Route::get('/upload', [PictureController::class, 'index']);
//Route upload photo
Route::post('/upload', [PictureController::class, 'store']);

//Route crud house
Route::resource('/houses', HouseController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
]);