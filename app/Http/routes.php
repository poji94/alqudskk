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
Route::get('/searchUserReservation', 'ReservationController@searchUserReservation')->name('reservation.searchUserReservation');
Route::get('/filterReservationStatus', 'ReservationController@filterReservationStatus')->name('reservation.filterReservationStatus');
Route::get('/filterReservationStatusUser', 'ReservationController@filterReservationStatusUser')->name('reservation.filterReservationStatusUser');
Route::get('/getUserReservation', 'ReservationController@getUserReservation')->name('reservation.getUserReservation');
Route::get('cancelReservation', 'ReservationController@cancelReservation')->name('reservation.cancelReservation');

Route::post('/reservation/payWithStripe/{reservation}', 'ReservationController@payWithStripe')->name('reservation.payWithStripe');

Route::get('/cartItinerary', 'ReservationController@cartItinerary')->name('reservation.cartItinerary');
Route::get('/reservation/addMoreItinerary', 'ReservationController@addMoreItinerary')->name('reservation.addMoreItinerary');
Route::get('/reservation/removeItineraryFromSession/{id}', 'ReservationController@removeItineraryFromSession')->name('reservation.removeItineraryFromSession');
Route::post('/reservation/createItinerary/', 'ReservationController@createItinerary')->name('reservation.createItinerary');
Route::post('/reservation/storedItinerary/', 'ReservationController@storeItinerary')->name('reservation.storeItinerary');
Route::get('/reservation/editItinerary/{reservation}', 'ReservationController@editItinerary')->name('reservation.editItinerary');
Route::post('/reservation/editItinerary/{reservation}', 'ReservationController@updateItinerary')->name('reservation.updateItinerary');
Route::get('/reservation/showItinerary/{reservation}', 'ReservationController@showItinerary')->name('reservation.showItinerary');
Route::get('/reservation/reviewItinerary/{reservation}', 'ReservationController@reviewItinerary')->name('reservation.reviewItinerary');
Route::post('/reservation/reviewItinerary/{reservation}', 'ReservationController@postReviewItinerary')->name('reservation.postReviewItinerary');

Route::get('/cartPackageTour', 'ReservationController@cartPackageTour')->name('reservation.cartPackageTour');
Route::get('/reservation/removePackageTourFromSession/{id}', 'ReservationController@removePackageTourFromSession')->name('reservation.removePackageTourFromSession');
Route::get('/reservation/createPackageTour/{packagetour}', 'ReservationController@createPackageTour')->name('reservation.createPackageTour');
Route::post('/reservation/storedPackageTour', 'ReservationController@storePackageTour')->name('reservation.storePackageTour');
Route::get('/reservation/editPackageTour/{reservation}', 'ReservationController@editPackageTour')->name('reservation.editPackageTour');
Route::post('/reservation/editPackageTour/{reservation}', 'ReservationController@updatePackageTour')->name('reservation.updatePackageTour');
Route::get('/reservation/showPackageTour/{reservation}', 'ReservationController@showPackageTour')->name('reservation.showPackageTour');
Route::get('/reservation/reviewPackageTour/{reservation}', 'ReservationController@reviewPackageTour')->name('reservation.reviewPackageTour');
Route::post('/reservation/reviewPackageTour/{reservation}', 'ReservationController@postReviewPackageTour')->name('reservation.postReviewPackageTour');
