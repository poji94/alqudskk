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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('/user', 'UserController');

Route::resource('/itinerary', 'ItineraryController');

Route::resource('/packagetour', 'PackageTourController');
Route::get('/packagetour/createItineraries', 'PackageTourController@createItineraries')->name('packageTour.createItineraries');
//Route::get('/packagetour/editItineraries', 'PackageTourController@editItineraries')->name('packageTour.editItineraries');
Route::patch('/packagetour', 'PackageTourController@storeItineraries')->name('packageTour.storeItineraries');

Route::resource('/reservation', 'ReservationController');
Route::get('/reservation/createReservationVacation', 'ReservationController@createReservationVacation')->name('reservation.createReservationVacation');
Route::patch('/reservation', 'ReservationController@storeReservationVacation')->name('reservation.storeReservationVacation');
