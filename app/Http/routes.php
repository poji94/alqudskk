<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('/user', 'UserController');

Route::resource('/itinerary', 'ItineraryController');
Route::get('/itinerarySelection', 'ItineraryController@getSelection')->name('itinerary.getSelection');
Route::get('/itinerarySelection/filter', 'ItineraryController@filterSelection')->name('itinerary.filterSelection');

Route::resource('/packagetour', 'PackageTourController');
Route::get('/packageTourSelection', 'PackageTourController@getSelection')->name('packagetour.getSelection');
Route::get('/packageTourSelection/filter', 'PackageTourController@filterSelection')->name('packagetour.filterSelection');

Route::resource('/reservation', 'ReservationController');
Route::get('/userReservation', 'ReservationController@getUserReservation')->name('reservation.getUserReservation');