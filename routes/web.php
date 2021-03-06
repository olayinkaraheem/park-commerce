<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cart', 'CartController@index')->name('cart')->middleware('auth');
Route::post('/cart/add', 'CartController@store')->name('cart.store')->middleware('auth');
Route::get('/cart/{item}', 'CartController@remove')->name('cart.delete')->middleware('auth');

Route::post('/cart/process-coupon', 'CouponController@process')->name('coupon.process');
