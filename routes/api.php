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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::post('page/show', [\App\Http\Controllers\Api\v1\PageController::class, 'show']);

    Route::group(['prefix' => 'ecommerce'], function () {
        Route::post('cart/add-item', [\App\Http\Controllers\Api\v1\Ecommerce\CartItemController::class, 'add']);
        Route::post('cart/update-item', [\App\Http\Controllers\Api\v1\Ecommerce\CartItemController::class, 'update']);
        Route::post('cart/delete-item', [\App\Http\Controllers\Api\v1\Ecommerce\CartItemController::class, 'delete']);

        Route::post('cart/detail', [\App\Http\Controllers\Api\v1\Ecommerce\CartController::class, 'detail']);
        
        Route::post('order/update', [\App\Http\Controllers\Api\v1\Ecommerce\OrderController::class, 'update']);
        Route::post('order/submit', [\App\Http\Controllers\Api\v1\Ecommerce\OrderController::class, 'submit']);
    });
    
});

Route::post('test', [\App\Http\Controllers\Api\v1\Ecommerce\TestController::class, 'submit']);

