<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\ProductManagement\App\Http\Controllers\Api\Frontend\FavouriteProductsController;
use Modules\ProductManagement\App\Http\Controllers\Api\Frontend\ProductsController;
use Modules\ProductManagement\App\Models\ProductFavouriteUser;

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

Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {
    Route::get('productmanagement', fn(Request $request) => $request->user())->name('productmanagement');
});

Route::group(['prefix' => 'frontend'], function () {

    Route::get('products', [ProductsController::class, 'list']);
    Route::get('products/show/{product}', [ProductsController::class, 'show']);


    Route::get('products/bestOffers', [ProductsController::class, 'bestOffers']);
    Route::get('products/bestSeller', [ProductsController::class, 'bestSeller']);

    /**Show Product */
    Route::get('products/show/{product}', [ProductsController::class, 'show']);
    Route::get('products/getProductSimilarProductsPaginated/{product}', [ProductsController::class, 'getProductSimilarProductsPaginated']);
    Route::get('products/reviewsPaginated/{product}', [ProductsController::class, 'getProductReviewsPaginated']);

    Route::post('products/filter', [ProductsController::class, 'filter']);
    Route::get('products/filter/attributes', [ProductsController::class, 'attributes']);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('products/favourites', [FavouriteProductsController::class, 'fetchFavouriteProducts']);
        Route::get('products/favourites/toggleFavourite/{product}', [FavouriteProductsController::class, 'toggleFavourite']);
    });
});
