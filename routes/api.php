<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DjController;
use App\Http\Controllers\ClubController;
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

/**********************
 *** CONNECTED USER ***
/******************* */

// route clubs
Route::post('club/create', [ClubController::class, 'create'])
/*->middleware('ismanagerclub')*/;
Route::put('club/update/{id}', [ClubController::class, 'update'])
/*->middleware('ismanagerclub')*/;
Route::delete('club/delete/{id}', [ClubController::class, 'delete'])
/*->middleware('ismanagerclub')*/;
Route::post('club/uploads/{id}', [ClubController::class, 'uploadFiles'])
/*->middleware('ismanagerclub')*/;


/********************
 *** NOT CONNECTED ***
/***************** */

//Route club
Route::get('club', [ClubController::class, 'getAll']);
Route::get('club/{id}', [ClubController::class, 'getOne']);

//Route dj
//Route::get('/dj', [DjController::class, 'getAll']);
//Route::get('/dj/:id', [DjController::class, 'getOne']);

//Route dancer
//Route::get('/dancer', [DancerController::class, 'getAll']);
//Route::get('/dancer/:id', [DancerController::class, 'getOne']);

//Route party
//Route::get('/party', [PartyController::class, 'getAll']);
//Route::get('/party/:id', [PartyController::class, 'getOne']);