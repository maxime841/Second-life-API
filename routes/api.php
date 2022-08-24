<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PictureController;

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

//Route afficher les photos land
Route::get('/upload_land', [PictureController::class, 'index_land']);

//Route afficher les photos house
Route::get('/upload_house', [PictureController::class, 'index_house']);

//Route afficher les photos club
Route::get('/upload_club', [PictureController::class, 'index_club']);

//Route afficher les photos dj
Route::get('/upload_dj', [PictureController::class, 'index_dj']);

//Route afficher les photos dancer
Route::get('/upload_dancer', [PictureController::class, 'index_dancer']);

//Route upload photo
Route::post('/upload', [PictureController::class, 'store']);

//Route crud house
Route::resource('/houses', HouseController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

//Route crud tenant
Route::resource('/tenants', TenantController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

// routes for authentication
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// redirect on route after click email verified email
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifiedAuthEmail'])
    ->middleware(['signed'])->name('verification.verify');

// routes user connected
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // routes auth
    Route::get('auth/verified', [AuthController::class, 'verifiedAuth']);
    Route::delete('auth/logout', [AuthController::class, 'logout']);
});
