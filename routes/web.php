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

Route::get('/', 'App\Http\Controllers\MainController@index');

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

// Reviews
Route::post('reviews/add', 'App\Http\Controllers\Web\Review\ReviewController@store');

// Ajax
Route::get('/ajax/product', 'App\Http\Controllers\Web\Product\ProductController@getproductCartAjax');
Route::get('/ajax/cart', 'App\Http\Controllers\Web\Cart\CartController@getCartAjax');
Route::get('/ajax/cart-success', 'App\Http\Controllers\Web\Cart\CartController@getItemAddedToCartPopup');
Route::get('/ajax/pochta-count', 'App\Http\Controllers\Api\Pochta\PochtaController@calcDelivery');
Route::post('/ajax/order', 'App\Http\Controllers\Api\Order\OrderController@makeOrder');
Route::get('/ajax/sizes', 'App\Http\Controllers\MainController@getSizes');
Route::post('/ajax/order-success', 'App\Http\Controllers\Web\Order\OrderController@showOrderSuccessPopup');
Route::get('/ajax/reviews', 'App\Http\Controllers\Web\Review\ReviewController@loadMore');


Route::get('/get-token', function () {
   return csrf_token();
});
