<?php

use Illuminate\Http\Request;
use Modules\Bookable\Models\Calendar;

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
Route::group(['prefix' => 'bookable'], function () {
    Route::get('calendar', function () {
        // If the Content-Type and Accept headers are set to 'application/json', 
        // this will return a JSON structure. This will be cleaned up later.
        return Calendar::all();
    })->name('bookable.api.calendar.index');
});
