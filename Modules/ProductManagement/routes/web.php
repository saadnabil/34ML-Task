<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductManagement\App\Http\Controllers\ProductManagementController;

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

Route::group([], function () {
    Route::resource('productmanagement', ProductManagementController::class)->names('productmanagement');
});
