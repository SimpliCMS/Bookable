<?php

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
Route::prefix('bookable')->group(function () {
Route::get('/', 'BookableController@index')->name('bookable.index');
Route::get('{slug}', 'BookableController@show')->name('bookable.show');
 Route::post('cart/add/{bookable}', 'BookableController@addCartItem')->name('bookable.cart.add');
});    