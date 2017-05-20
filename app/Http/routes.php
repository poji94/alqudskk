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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::auth();

Route::get('/', 'HomeController@index');

Route::resource('/user', 'UserController');

Route::resource('/itinerary', 'ItineraryController');
Route::get('/itinerarySelection', 'ItineraryController@getSelection')->name('itinerary.getSelection');
Route::get('/itinerarySelection/filter', 'ItineraryController@filterSelection')->name('itinerary.filterSelection');
Route::get('/itinerarySelection/changeCurrency', 'ItineraryController@changeCurrency')->name('itinerary.changeCurrency');

Route::resource('/packagetour', 'PackageTourController');
Route::get('/packageTourSelection', 'PackageTourController@getSelection')->name('packagetour.getSelection');
Route::get('/packageTourSelection/filter', 'PackageTourController@filterSelection')->name('packagetour.filterSelection');
Route::get('/packageTourSelection/changeCurrency', 'PackageTourController@changeCurrency')->name('packagetour.changeCurrency');

Route::resource('/reservation', 'ReservationController');
Route::get('/filterReservationStatus', 'ReservationController@filterReservationStatus')->name('reservation.filterReservationStatus');
Route::get('/filterReservationStatusUser', 'ReservationController@filterReservationStatusUser')->name('reservation.filterReservationStatusUser');
Route::get('/reservation/createReservation/{packagetour}', 'ReservationController@createPackageTour')->name('reservation.createPackageTour');
Route::post('/getUserReservation', 'ReservationController@storePackageTour')->name('reservation.storePackageTour');
Route::get('/getUserReservation', 'ReservationController@getUserReservation')->name('reservation.getUserReservation');
Route::get('cancelReservation', 'ReservationController@cancelReservation')->name('reservation.cancelReservation');
Route::post('/reservation/payWithStripe/{reservation}', 'ReservationController@payWithStripe')->name('reservation.payWithStripe');
Route::get('/reservation/editPackageTour/{packagetour}', 'ReservationController@editPackageTour')->name('reservation.editPackageTour');
Route::post('/reservation/editPackageTour/{packagetour}', 'ReservationController@updatePackageTour')->name('reservation.updatePackageTour');
Route::get('/reservation/showPackageTour/{packagetour}', 'ReservationController@showPackageTour')->name('reservation.showPackageTour');
Route::get('/reservation/reviewPackageTour/{packagetour}', 'ReservationController@reviewPackageTour')->name('reservation.reviewPackageTour');
Route::post('/reservation/reviewPackageTour/{packagetour}', 'ReservationController@postReviewPackageTour')->name('reservation.postReviewPackageTour');
