<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

/**********************
 *** AUTHENTICATION ****
/******************* */

// routes for authentication
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// redirect on route after click email verified email
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifiedAuthEmail'])
    ->middleware(['signed'])->name('verification.verify');

/**********************
 *** FORGOT PASSWORD ***
/******************* */

// send email for update password
Route::post('/forgot-password', [UserController::class, 'forgotPassword'])
    ->name('password.email');
// redirect on front for update password
Route::get('/reset-password/{token}', [UserController::class, 'redirectForgotPassword'])
    ->name('password.reset');
// update password
Route::post('/reset-password', [UserController::class, 'updateForgotPassword'])
    ->name('password.update');

/**********************
 *** CONNECTED USER ***
/******************* */

// routes user connected
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // routes auth
    Route::get('auth/verified', [AuthController::class, 'verifiedAuth'])
        ->middleware('ispublic');
    Route::delete('auth/logout', [AuthController::class, 'logout'])
        ->middleware('ispublic');

    // route user
    Route::get('user/profil', [UserController::class, 'getProfil'])
        ->middleware('ispublic');
    Route::put('user/profil/update', [UserController::class, 'updateProfil'])
        ->middleware('ispublic');
    Route::post('user/profil/update/password', [UserController::class, 'updatePassword'])
        ->middleware('ispublic');

    // route roles
    Route::get('roles', [RoleController::class, 'getAll'])
        ->middleware(['isadmin']);
    Route::get('role/{id}', [RoleController::class, 'getOne'])
        ->middleware(['isroot']);
    Route::post('role/create', [RoleController::class, 'create'])
        ->middleware(['isroot']);
    Route::put('role/update/{id}', [RoleController::class, 'update'])
        ->middleware(['isroot']);
    Route::delete('role/delete/{id}', [RoleController::class, 'delete'])
        ->middleware(['isroot']);

    // route lands
    Route::post('land/create', [LandController::class, 'create'])
        ->middleware('isadmin');
    Route::put('land/update/{id}', [LandController::class, 'update'])
        ->middleware('isadmin');
    Route::delete('land/delete/{id}', [LandController::class, 'delete'])
        ->middleware('isadmin');
    Route::post('land/uploads/{id}', [LandController::class, 'uploadFiles'])
        ->middleware('isadmin');
});

// route lands
Route::get('lands', [LandController::class, 'getAll']);
Route::get('land/{id}', [LandController::class, 'getOne']);
