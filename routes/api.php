<?php

use App\Http\Controllers\Api\Cart\CartController;
use App\Http\Controllers\Api\Payment\PaymentController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Review\ReviewController;
use App\Http\Controllers\Api\Nested\ProductReviewController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('products', ProductController::class)
    ->only([
        'index',
        'show',
    ]);

Route::resource('products.reviews', ProductReviewController::class)
    ->only([
        'index',
    ]);

Route::resource('payment', PaymentController::class)
    ->only([
        'index',
    ]);
