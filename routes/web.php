<?php

use App\Http\Controllers\Api\Cart\CartController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('cart', CartController::class)
    ->only([
        'index',
        'update',
        'destroy',
    ]);

Route::get('/cart/get-total', 'App\Http\Controllers\Api\Cart\CartController@getTotal');
Route::get('/cart/get-count', 'App\Http\Controllers\Api\Cart\CartController@getItemsCount');
Route::get('/cart/get-delivery-options', 'App\Http\Controllers\Api\Cart\CartController@getOptionsForDelivery');

// CDEK SDK
Route::get('/cdek/city-autofill', 'App\Http\Controllers\Api\Cdek\CdekController@getCityAutoFill');
Route::post('/cdek/get-delivery-price', 'App\Http\Controllers\Api\Cdek\CdekController@getDeliveryPrice');

// Payment
Route::post('/payment/result', 'App\Http\Controllers\Api\Payment\PaymentController@validateResult');

Route::get('/get-token', function () {
   return csrf_token();
});
