<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItineraryCreateReservationRequest;
use App\Http\Requests\ReservationReviewItineraryRequest;
use App\Http\Requests\ReservationStoreItineraryRequest;
use App\Http\Requests\ReservationStorePackageTourRequest;
use App\Http\Requests\ReservationUpdateItineraryRequest;
use App\Http\Requests\ReservationUpdatePackageTourRequest;
use App\Http\Requests\ReservationReviewPackageTourRequest;
use App\Itinerary;
use App\PackageTour;
use App\Reservation;
use App\Currency;
use App\ReservationStatus;
use App\ReservationType;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Redis;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list out all reservation objects
        $reservations = Reservation::all();
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        $reservationStatusIds = ReservationStatus::lists('name', 'id')->all();
        return view('reservation.index', compact('reservations', 'currency', 'reservationStatusIds'));
    }

    public function getUserReservation()
    {
        $reservations = Reservation::where('user_id', Auth::user()->id)->get();
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        $reservationStatusIds = ReservationStatus::lists('name', 'id')->all();
        return view('reservation.indexUser', compact('reservations', 'currency', 'reservationStatusIds'));
    }

    public function filterReservationStatus(Request $request)
    {
        $input = $request->all();
        $reservations = Reservation::where('reservation_status_id', $input['reservation_status_id'])->get();
        $reservationStatusIds = ReservationStatus::lists('name', 'id')->all();
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        return view('reservation.index', compact('reservations', 'currency', 'reservationStatusIds'));
    }

    public function filterReservationStatusUser(Request $request)
    {
        $input = $request->all();
        $reservations = Reservation::where('user_id', Auth::user()->id)->where('reservation_status_id', $input['reservation_status_id'])->get();
        $reservationStatusIds = ReservationStatus::lists('name', 'id')->all();
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        return view('reservation.indexUser', compact('reservations', 'currency', 'reservationStatusIds'));
    }

    public function searchUserReservation(Request $request)
    {
        $input = $request->all();
        $userSearch = User::where('name', 'LIKE', '%' . $input['userSearch'] . '%')->first();
        $reservations = Reservation::where('user_id', $userSearch['id'])->get();
        $reservationStatusIds = ReservationStatus::lists('name', 'id')->all();
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        return view('reservation.index', compact('reservations', 'reservationStatusIds', 'currency'));
    }

    public function cartPackageTour()
    {
        $i = 1;
        $reservedPackageTours = [];

        $sessionPackageTours = session()->get('collectionReservedPackageTours');

        if($sessionPackageTours != null) {
            foreach($sessionPackageTours as $sessionPackageTour) {
                $reservedPackageTours[$i] = PackageTour::where('id', $sessionPackageTour)->first();
                $i++;
            }
        }
        return view('reservation.createPackageTour', compact('reservedPackageTours'));
    }

    public function cartItinerary()
    {
        $reservedItineraries = [];
        $reservedItinerariesOption = [];
        $reservedDayItineraries = [];

        $sessionItineraries = session()->get('collectionReservedItineraries');
        $sessionItinerariesOption = session()->get('collectionReservedItinerariesOption');
        $sessionDayItineraries = session()->get('dayItineraries');

        $i = 1;
        if($sessionDayItineraries != []) {
            foreach($sessionDayItineraries as $sessionDayItinerary) {
                $reservedDayItineraries[$i] = $sessionDayItinerary;
                $i++;
            }
        }

        $i = 1;
        if($sessionItineraries != null) {
            foreach ($sessionItineraries as $sessionItinerary) {
                $reservedItineraries[$i] = Itinerary::where('id', $sessionItinerary)->first();
                $i++;
            }
        }

        $i = 1;
        if($sessionItinerariesOption != []) {
            foreach($sessionItinerariesOption as $sessionItineraryOption) {
                $reservedItinerariesOption[$i] = $sessionItineraryOption;
                $i++;
            }
        }

        return view('reservation.createItinerary', compact('reservedItineraries', 'reservedItinerariesOption', 'reservedDayItineraries'));
    }

    public function createPackageTour(Request $request)
    {
        $input = $request->all();
        $i = 1;
        $reservedPackageTours = [];

        session()->push('collectionReservedPackageTours', $input['id']);

        $sessionPackageTours = session()->get('collectionReservedPackageTours');
        foreach($sessionPackageTours as $sessionPackageTour) {
            $reservedPackageTours[$i] = PackageTour::where('id', $sessionPackageTour)->first();
            $i++;
        }

        return view('reservation.createPackageTour', compact('reservedPackageTours'));
    }

    public function createItinerary(ItineraryCreateReservationRequest $request)
    {
        $input = $request->all();
        $reservedItineraries = [];
        $reservedItinerariesOption = [];
        $reservedDayItineraries = [];

        $request->session()->push('collectionReservedItineraries', $input['id']);
        $request->session()->push('collectionReservedItinerariesOption', $input['option']);

        $sessionItineraries = session()->get('collectionReservedItineraries');
        $sessionItinerariesOption = session()->get('collectionReservedItinerariesOption');
        $sessionDayItineraries = session()->get('dayItineraries');

        $i =1;
        foreach ($sessionItineraries as $sessionItinerary) {
            $reservedItineraries[$i] = Itinerary::where('id', $sessionItinerary)->first();
            $i++;
        }

        $i = 1;
        foreach($sessionItinerariesOption as $sessionItineraryOption) {
            $reservedItinerariesOption[$i] = $sessionItineraryOption;
            $i++;
        }

        $dayItineraries = 1;
        $i = 2;
        if($sessionDayItineraries != []) {
            foreach($sessionDayItineraries as $sessionDayItinerary) {
                if($reservedItinerariesOption[$i - 1] == 1) {
                    $dropOffPreviousItinerary = $reservedItineraries[$i - 1]['option1_dropoff_time'];
                }
                elseif($reservedItinerariesOption[$i - 1] == 2) {
                    $dropOffPreviousItinerary =  $reservedItineraries[$i - 1]['option2_dropoff_time'];
                }

                if($reservedItinerariesOption[$i] == 1) {
                    $pickupCurrentItinerary = $reservedItineraries[$i]['option1_pickup_time'];
                }
                elseif($reservedItinerariesOption[$i] == 2) {
                    $pickupCurrentItinerary = $reservedItineraries[$i]['option2_pickup_time'];
                }

                if($sessionDayItinerary == $dayItineraries) {
                    if(Carbon::parse($pickupCurrentItinerary)->lessThanOrEqualTo(Carbon::parse($dropOffPreviousItinerary))) {
                        $dayItineraries++;
                    }
                }
                $i++;
            }

        }
        $request->session()->push('dayItineraries', $dayItineraries);
        $sessionDayItineraries = session()->get('dayItineraries');
        $i = 1;
        if($sessionDayItineraries != []) {
            foreach($sessionDayItineraries as $sessionDayItinerary) {
                $reservedDayItineraries[$i] = $sessionDayItinerary;
                $i++;
            }
        }

        return view('reservation.createItinerary', compact('reservedItineraries', 'reservedItinerariesOption', 'reservedDayItineraries'));
    }

    public function removePackageTourFromSession($id)
    {
        $i = 1;
        $reservedPackageTours = [];
        $sessionPackageTours = session()->pull('collectionReservedPackageTours');

        $id--;
        unset($sessionPackageTours[$id]);

        if($sessionPackageTours != []) {
            $sessionPackageTours = array_values($sessionPackageTours);
            foreach ($sessionPackageTours as $sessionPackageTour) {
                $reservedPackageTours[$i] = PackageTour::where('id', $sessionPackageTour)->first();
                $i++;
            }
            session()->put('collectionReservedPackageTours', $sessionPackageTours);
        }

        return view('reservation.createPackageTour', compact('reservedPackageTours'));
    }

    public function removeItineraryFromSession($id)
    {
        $reservedItineraries = [];
        $reservedItinerariesOption = [];
        $reservedDayItineraries = [];

        $sessionItineraries = session()->pull('collectionReservedItineraries');
        $sessionItinerariesOption = session()->pull('collectionReservedItinerariesOption');
        $sessionDayItineraries = session()->pull('dayItineraries');

        $id--;
        unset($sessionItineraries[$id]);
        unset($sessionItinerariesOption[$id]);
        unset($sessionDayItineraries[$id]);

        $i = 1;
        if($sessionItineraries != []) {
            $sessionItineraries = array_values($sessionItineraries);
            foreach ($sessionItineraries as $sessionItinerary) {
                $reservedItineraries[$i] = Itinerary::where('id', $sessionItinerary)->first();
                $i++;
            }
            session()->put('collectionReservedItineraries', $sessionItineraries);
        }

        $i = 1;
        if($sessionItinerariesOption != []) {
            $sessionItinerariesOption = array_values($sessionItinerariesOption);
            foreach($sessionItinerariesOption as $sessionItineraryOption) {
                $reservedItinerariesOption[$i] = $sessionItineraryOption;
                $i++;
            }
            session()->put('collectionReservedItinerariesOption', $reservedItinerariesOption);
        }

        $dayItineraries = 0;
        $i = 0;
        if($sessionDayItineraries != []) {
            $sessionDayItineraries = array_values($sessionDayItineraries);
            foreach($sessionDayItineraries as $sessionDayItinerary) {
                if($sessionDayItineraries[$i] == ($dayItineraries + 1)) {
                    $dayItineraries++;
                }

                if($sessionDayItineraries[$i] == ($dayItineraries + 2)) {
                    $dayItineraries++;
                    $sessionDayItineraries[$i] = $dayItineraries;
                }
                $i++;
            }
            session()->put('dayItineraries', $sessionDayItineraries);
            $sessionDayItineraries = session()->get('dayItineraries');
            $i = 1;
            if($sessionDayItineraries != []) {
                foreach ($sessionDayItineraries as $sessionDayItinerary) {
                    $reservedDayItineraries[$i] = $sessionDayItinerary;
                    $i++;
                }
            }
        }

        return view('reservation.createItinerary', compact('reservedItineraries', 'reservedItinerariesOption', 'reservedDayItineraries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {}

    public function storePackageTour(ReservationStorePackageTourRequest $request)
    {
        //create the reservation instance object
        //initialize the sumPrice - for sum all the itineraries price
        //automate the user_id, reservation_status_id to pending, associate the itineraries/packagetour, durations
        //Note: reservation_type_id == 1 - Ground(activity). Else 2-full boat(packagetour)

        session()->forget('collectionReservedPackageTours');
        $sumPrice = 0;
        $duration = 0;
        $input = $request -> all();
        $reservation = Reservation::create($input);
        $reservation->update(['user_id'=>Auth::user()->id, 'reservation_status_id'=>1]);
        foreach($input['packagetour_id'] as $packagetour_id) {
            $reservation->packageTours()->attach($packagetour_id);                  //since package tour only receive string instead of array, must create an array bracket
        }

        foreach($reservation->packageTours as $packageTour) {
            if($input['price_type'] == 'personal') {
                foreach($packageTour->prices as $price) {
                    $sumPrice += $input['adult_no'] * $price->personal;
                }
            }
            else if($input['price_type'] == 'private_group') {
                foreach($packageTour->prices as $price) {
                    $sumPrice += ($input['adult_no'] * $price->private_group_adult) + ($input['children_no'] * $price->private_group_children);
                }
            }
            else if($input['price_type'] == 'public_group') {
                foreach($packageTour->prices as $price) {
                    $sumPrice += ($input['adult_no'] * $price->public_group_adult) + ($input['children_no'] * $price->public_group_children);
                }
            }
            $duration += $packageTour->duration;
        }

        $mainReservationEnd = Carbon::parse($reservation->main_reservation_start)->addDays($duration)->toDateString();
        $alternateReservationEnd = Carbon::parse($reservation->alternate_reservation_start)->addDays($duration)->toDateString();
        $reservation->update(['price' => $sumPrice, 'main_reservation_end'=>$mainReservationEnd, 'alternate_reservation_end'=>$alternateReservationEnd]);

        Session::flash('created_reservation', 'Reservation for ' . $reservation->reserveUser->name . ' successfully created');
        if(Auth::user()->role_user_id == 3) {
            return redirect(route('reservation.getUserReservation'));
        }
        else {
            return redirect(route('reservation.index'));
        }
    }

    public function storeItinerary(ReservationStoreItineraryRequest $request)
    {
        //create the reservation instance object
        //initialize the sumPrice - for sum all the itineraries price
        //automate the user_id, reservation_status_id to pending, associate the itineraries/packagetour, durations
        //Note: reservation_type_id == 1 - Ground(activity). Else 2-full boat(packagetour)

        $reservedItinerariesOption =  session()->pull('collectionReservedItinerariesOption');
        $reservedDayItineraries = session()->pull('dayItineraries');
        session()->forget('collectionReservedItineraries');
        $sumPrice = 0;
        $input = $request -> all();
        $reservation = Reservation::create($input);
        $reservation->update(['user_id'=>Auth::user()->id, 'reservation_status_id'=>1]);

        $i=0;
        foreach($input['itinerary_id'] as $itinerary_id) {
            $reservation->itineraries()->attach($itinerary_id, ['day'=>$reservedDayItineraries[$i], 'option'=>$reservedItinerariesOption[$i]]);                  //since package tour only receive string instead of array, must create an array bracket
            $i++;
        }

        foreach($reservation->itineraries as $itinerary) {
            if($input['price_type'] == 'personal') {
                foreach($itinerary->prices as $price) {
                    $sumPrice += $input['adult_no'] * $price->personal;
                }
            }
            else if($input['price_type'] == 'private_group') {
                foreach($itinerary->prices as $price) {
                    $sumPrice += ($input['adult_no'] * $price->private_group_adult) + ($input['children_no'] * $price->private_group_children);
                }
            }
            else if($input['price_type'] == 'public_group') {
                foreach($itinerary->prices as $price) {
                    $sumPrice += ($input['adult_no'] * $price->public_group_adult) + ($input['children_no'] * $price->public_group_children);
                }
            }
        }

        $dayItineraries = count($reservedDayItineraries);

        $mainReservationEnd = Carbon::parse($reservation->main_reservation_start)->addDays($reservedDayItineraries[$dayItineraries - 1])->toDateString();
        $alternateReservationEnd = Carbon::parse($reservation->alternate_reservation_start)->addDays($reservedDayItineraries[$dayItineraries - 1])->toDateString();
        $reservation->update(['price' => $sumPrice, 'main_reservation_end'=>$mainReservationEnd, 'alternate_reservation_end'=>$alternateReservationEnd]);

        Session::flash('created_reservation', 'Reservation for ' . $reservation->reserveUser->name . ' successfully created');
        if(Auth::user()->role_user_id == 3) {
            return redirect(route('reservation.getUserReservation'));
        }
        else {
            return redirect(route('reservation.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {}

    public function showPackageTour($id)
    {
        $reservation = Reservation::findOrFail($id);
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        $packagetours = PackageTour::lists('name', 'id')->all();
        if($reservation->remarks_by != null) {
            $remarksBy = User::findOrFail($reservation->remarks_by);
        }
        return view('reservation.showPackageTour', compact('reservation','packagetours', 'currency', 'remarksBy'));
    }

    public function showItinerary($id)
    {
        $reservation = Reservation::findOrFail($id);
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        $itineraries = Itinerary::lists('name', 'id')->all();
        if($reservation->remarks_by != null) {
            $remarksBy = User::findOrFail($reservation->remarks_by);
        }
        return view('reservation.showItinerary', compact('reservation', 'itineraries', 'currency', 'remarksBy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {}

    public function editPackageTour($id)
    {
        $reservation = Reservation::findOrFail($id);
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        return view('reservation.editPackageTour', compact('reservation', 'currency'));
    }

    public function editItinerary($id)
    {
        $reservation = Reservation::findOrFail($id);
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        return view('reservation.editItinerary', compact('reservation', 'currency'));
    }

    public function reviewPackageTour($id)
    {
        $reservation = Reservation::findOrFail($id);
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        $reservationStatusIds = ReservationStatus::lists('name', 'id')->all();
        return view('reservation.reviewPackageTour', compact('reservation', 'reservationStatusIds', 'currency'));
    }

    public function reviewItinerary($id)
    {
        $reservation = Reservation::findOrFail($id);
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        $reservationStatusIds = ReservationStatus::lists('name', 'id')->all();
        return view('reservation.reviewItinerary', compact('reservation', 'reservationStatusIds','currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {}

    public function updatePackageTour(ReservationUpdatePackageTourRequest $request, $id)
    {
        //pretty much similar to the store reservation
        //this updates the particular reservation
        $sumPrice = 0;
        $duration = 0;
        $input = $request -> all();
        $reservation = Reservation::findOrFail($id);
        $reservation->update($input);

        foreach ($reservation->packageTours as $packageTour) {
            if ($input['price_type'] == 'personal') {
                foreach ($packageTour->prices as $price) {
                    $sumPrice += $input['adult_no'] * $price->personal;
                }
            } else if ($input['price_type'] == 'private_group') {
                foreach ($packageTour->prices as $price) {
                    $sumPrice += ($input['adult_no'] * $price->private_group_adult) + ($input['children_no'] * $price->private_group_children);
                }
            } else if ($input['price_type'] == 'public_group') {
                foreach ($packageTour->prices as $price) {
                    $sumPrice += ($input['adult_no'] * $price->public_group_adult) + ($input['children_no'] * $price->public_group_children);
                }
            }
            $duration += $packageTour->duration;
        }

        $mainReservationEnd = Carbon::parse($reservation->main_reservation_start)->addDays($duration)->toDateString();
        $alternateReservationEnd = Carbon::parse($reservation->alternate_reservation_start)->addDays($duration)->toDateString();
        $reservation->update(['price' => $sumPrice, 'main_reservation_end'=>$mainReservationEnd, 'alternate_reservation_end'=>$alternateReservationEnd]);

        Session::flash('updated_reservation', 'Reservation for ' . $reservation->reserveUser->name . ' successfully updated');
        if(Auth::user()->role_user_id == 3) {
            return redirect(route('reservation.getUserReservation'));
        }
        else {
            return redirect(route('reservation.index'));
        }
    }

    public function updateItinerary(ReservationUpdateItineraryRequest $request, $id)
    {
        //pretty much similar to the store reservation
        //this updates the particular reservation
        $sumPrice = 0;
        $input = $request -> all();
        $reservation = Reservation::findOrFail($id);
        $reservation->update($input);

        foreach($reservation->itineraries as $itinerary) {
            if($input['price_type'] == 'personal') {
                foreach($itinerary->prices as $price) {
                    $sumPrice += $input['adult_no'] * $price->personal;
                }
            }
            else if($input['price_type'] == 'private_group') {
                foreach($itinerary->prices as $price) {
                    $sumPrice += ($input['adult_no'] * $price->private_group_adult) + ($input['children_no'] * $price->private_group_children);
                }
            }
            else if($input['price_type'] == 'public_group') {
                foreach($itinerary->prices as $price) {
                    $sumPrice += ($input['adult_no'] * $price->public_group_adult) + ($input['children_no'] * $price->public_group_children);
                }
            }
            $dayItineraries = $itinerary->pivot->day;
        }

        $mainReservationEnd = Carbon::parse($reservation->main_reservation_start)->addDays($dayItineraries)->toDateString();
        $alternateReservationEnd = Carbon::parse($reservation->alternate_reservation_start)->addDays($dayItineraries)->toDateString();
        $reservation->update(['price' => $sumPrice, 'main_reservation_end'=>$mainReservationEnd, 'alternate_reservation_end'=>$alternateReservationEnd]);

        Session::flash('updated_reservation', 'Reservation for ' . $reservation->reserveUser->name . ' successfully updated');
        if(Auth::user()->role_user_id == 3) {
            return redirect(route('reservation.getUserReservation'));
        }
        else {
            return redirect(route('reservation.index'));
        }
    }

    public function postReviewPackageTour(ReservationReviewPackageTourRequest $request, $id)
    {
        //pretty much similar to the store reservation
        //this updates the particular reservation
        $input = $request -> all();
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['reservation_status_id'=>$input['reservation_status_id'], 'chosen_date'=>$input['chosen_date'], 'remarks'=>$input['remarks'], 'remarks_by'=>Auth::user()->id]);

        Session::flash('reviewed_reservation', 'Reservation for ' . $reservation->reserveUser->name . ' successfully reviewed');
        return redirect(route('reservation.index'));
    }

    public function postReviewItinerary(ReservationReviewItineraryRequest $request, $id)
    {
        //pretty much similar to the store reservation
        //this updates the particular reservation
        $input = $request -> all();
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['reservation_status_id'=>$input['reservation_status_id'], 'chosen_date'=>$input['chosen_date'], 'remarks'=>$input['remarks'], 'remarks_by'=>Auth::user()->id]);

        Session::flash('reviewed_reservation', 'Reservation for ' . $reservation->reserveUser->name . ' successfully reviewed');
        return redirect(route('reservation.index'));
    }

    public function cancelReservation(Request $request)
    {
        $input = $request->all();
        $reservation = Reservation::findOrFail($input['id']);
        $reservation->update(['reservation_status_id'=>2]);
        if(Auth::user()->role_user_id == 3) {
            return redirect(route('reservation.getUserReservation'));
        }
        else {
            return redirect(route('reservation.index'));
        }
    }

    public function destroy($id)
    {
        //delete everything related to particular reservation
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        $reservation->packageTours()->detach();
        $reservation->itineraries()->detach();

        Session::flash('deleted_reservation', 'Reservation for ' . $reservation->reserveUser->name . ' successfully deleted');
        if(Auth::user()->role_user_id == 3) {
            return redirect(route('reservation.getUserReservation'));
        }
        else {
            return redirect(route('reservation.index'));
        }
    }

    //payment section
    public function payWithStripe(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
//        $reservationPrice = preg_replace("/[^0-9,.]/", "",currency($reservation->price, currency()->config('default'), $currency['code']));
        $reservationPrice = preg_replace("/[^0-9]/", "",currency($reservation->price, currency()->config('default'), $currency['code']));
        return $this->chargeCustomer($reservation->id, (int)$reservationPrice, $reservation->reserveUser->name, $currency['code'], $request->input('stripeToken'));
    }

    public function chargeCustomer($reservationId, $reservationPrice, $reservationUserName, $currencyCode, $token)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        if(!$this->isStripeCustomer())
        {
            $customer = $this->createStripeCustomer($token);
        }
        else
        {
            $customer = \Stripe\Customer::retrieve(Auth::user()->stripe_id);
        }
        return $this->createStripeCharge($reservationId, $reservationPrice, $reservationUserName, $currencyCode, $customer);
    }

    public function createStripeCharge($reservationId, $reservationPrice, $reservationUserName, $currencyCode, $customer)
    {
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $reservationPrice,
                "currency" => $currencyCode,
                "customer" => $customer->id,
                "description" => $reservationUserName
            ));
        } catch(\Stripe\Error\Card $e) {
            return redirect()
                ->route('index')
                ->with('error', 'Your credit card was been declined. Please try again or contact us.');
        }

        return $this->postStoreOrder($reservationId);
    }

    public function createStripeCustomer($token)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = \Stripe\Customer::create(array(
            "description" => Auth::user()->email,
            "source" => $token
        ));

        Auth::user()->stripe_id = $customer->id;
        Auth::user()->save();

        return $customer;
    }

    public function isStripeCustomer()
    {
        return Auth::user() && \App\User::where('id', Auth::user()->id)->whereNotNull('stripe_id')->first();
    }

    public function postStoreOrder($reservationId)
    {
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }

        $reservation = Reservation::findOrFail($reservationId);
        $reservation->update(['user_id'=>Auth::user()->id, 'reservation_status_id'=>2]);

        $reservations = Reservation::where('user_id', Auth::user()->id)->get();

        Session::flash('paid_reservation', 'Reservation for ' . $reservation->reserveUser->name . ' successfully paid');
        return redirect()
            ->route('reservation.getUserReservation', compact('currency', 'reservations'));
    }
}
