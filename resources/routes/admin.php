<?php

/*
  |--------------------------------------------------------------------------
  | Admin Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register Admin web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" "auth" and "role" middleware groups to lock them to the Admin.
  |
 */
Route::group(['prefix' => 'bookable'], function () {
    Route::group(['prefix' => 'calendar'], function () {
        Route::get('/', 'CalendarController@index')->name('bookable.admin.calendar.index');
        Route::post('/', 'CalendarController@store')->name('bookable.admin.calendar.store');
        Route::post('/ajax', 'CalendarController@ajax')->name('bookable.admin.calendar.ajax');
    });
    Route::get('/', 'BookableController@index')->name('bookable.admin.index');
    Route::post('/', 'BookableController@store')->name('bookable.admin.store');
    Route::get('create', 'BookableController@create')->name('bookable.admin.create');
    Route::get('{bookable}', 'BookableController@show')->name('bookable.admin.show');
    Route::put('{bookable}', 'BookableController@update')->name('bookable.admin.update');
    Route::delete('{bookable}', 'BookableController@destroy')->name('bookable.admin.destroy');
    Route::get('{bookable}/edit', 'BookableController@edit')->name('bookable.admin.edit');
});
