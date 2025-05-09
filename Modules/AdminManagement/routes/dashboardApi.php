<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\AdminManagement\App\Http\Controllers\Api\Dashboard\AuthController;

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

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:admin');
});

Route::group(['prefix' => 'dashboard/auth', 'middleware' => ['auth:admin']], function() {
//    Route::post('create', function (){
//        return "lkjjgjfgjhghgjhkghjkhjk";
//    });
    Route::post('store', [AuthController::class,'store']);
    Route::post('update/{id}', [AuthController::class,'update']);
    Route::post('delete/{id}', [AuthController::class,'destroy']);
});

Route::middleware(['auth:admin'])->prefix('v1')->group(function () {
    Route::get('adminmanagement', fn (Request $request) => $request->user())->name('adminmanagement');
});

Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {
    Route::get('adminmanagement', fn (Request $request) => $request->user())->name('adminmanagement');
});
