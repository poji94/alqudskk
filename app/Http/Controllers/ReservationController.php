<?php

namespace App\Http\Controllers;

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
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function createPackageTour(Request $request, $id)
    {
        $i = 0;
        $reservedPackageTour = PackageTour::findOrFail($id);
//        $collectionReservedPackageTourArray = [];
//        $collectionReservedPackageTourColl = collect($reservedPackageTour);
//        array_push($collectionReservedPackageTourArray, $collectionReservedPackageTourColl);
//        if($request->session()->has('collectionReservedPackageTour')) {

//            $sessionReservedPackageTour = $request->session()->get('collectionReservedPackageTour');
//            array_push($collectionReservedPackageTourArray, $sessionReservedPackageTour);
//            $collectionReservedPackageTourArray->push($sessionReservedPackageTour);//
//            $collectionReservedPackageTour->merge($sessionReservedPackageTour);
//        }
        $request->session()->put('collectionReservedPackageTour', $reservedPackageTour);
        $packagetours = PackageTour::lists('name', 'id')->all();
//        dd($reservedPackageTour->prices);
//         dd($collectionReservedPackageTourArray);
//        return $request->session()->get('collectionReservedPackageTour');
//        return $request->session()->forget('collectionReservedPackageTour');
        return view('reservation.createPackageTour', compact('reservation', 'reservedPackageTour', 'packagetours', 'i'));
    }

    public function createItinerary(Request $request, $id)
    {
        $i = 0;
        $reservedItinerary = Itinerary::findOrFail($id);
//        $collectionReservedPackageTourArray = [];
//        $collectionReservedPackageTourColl = collect($reservedPackageTour);
//        array_push($collectionReservedPackageTourArray, $collectionReservedPackageTourColl);
//        if($request->session()->has('collectionReservedPackageTour')) {

//            $sessionReservedPackageTour = $request->session()->get('collectionReservedPackageTour');
//            array_push($collectionReservedPackageTourArray, $sessionReservedPackageTour);
//            $collectionReservedPackageTourArray->push($sessionReservedPackageTour);//
//            $collectionReservedPackageTour->merge($sessionReservedPackageTour);
//        }
        $request->session()->put('collectionReservedPackageTour', $reservedItinerary);
        $itineraries = Itinerary::lists('name', 'id')->all();
//        dd($reservedPackageTour->prices);
//         dd($collectionReservedPackageTourArray);
//        return $request->session()->get('collectionReservedPackageTour');
//        return $request->session()->forget('collectionReservedPackageTour');
        return view('reservation.createItinerary', compact('reservation', 'reservedItinerary', 'itineraries', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //list the itineraries and packagetours
        $itineraries = Itinerary::lists('name', 'id')->all();
        $packagetours = PackageTour::lists('name', 'id')->all();
        return view('reservation.create', compact('itineraries', 'packagetours'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //create the reservation instance object
        //initialize the sumPrice - for sum all the itineraries price
        //automate the user_id, reservation_status_id to pending, associate the itineraries/packagetour, durations
        //Note: reservation_type_id == 1 - Ground. Else (2) is full boat
        $sumPrice = 0;
        $input = $request -> all();
        $reservation = Reservation::create($input);
        $reservation->update(['user_id'=>Auth::user()->id, 'reservation_status_id'=>1]);
        if($input['reservation_type_id'] == 1) {
            $reservation->itineraries()->sync($input['itinerary_id']);
            $itineraries = Itinerary::findOrFail($input['itinerary_id']);
            $tempAddDays = 0;
            foreach ($itineraries as $itinerary) {
                $sumPrice += ($input['children_no'] * $itinerary->price_children) + ($input['adult_no'] * $itinerary->price_adult);

                $duration = $itinerary->duration;
                $trimDuration = $duration[0];
                $tempAddDays += $trimDuration;
            }
            $reservationEnd = Carbon::parse($reservation->reservation_start)->addDays($tempAddDays)->toDateString();
            $reservation->update(['price' => $sumPrice, 'reservation_end'=>$reservationEnd]);
        }
        else if($input['reservation_type_id'] == 2 ) {
            $reservation->packageTour()->sync([$input['packagetour_id']]);                  //since package tour only receive string instead of array, must create an array bracket
            $packagetour = PackageTour::findOrFail($input['packagetour_id']);

            $sumPrice += ($input['children_no'] * $packagetour->price_children) + ($input['adult_no'] * $packagetour->price_adult);

            $duration = $packagetour->duration;
            $trimDuration = $duration[0];
            $reservationEnd = Carbon::parse($reservation->reservation_start)->addDays($trimDuration)->toDateString();
            $reservation->update(['price' => $sumPrice, 'reservation_end'=>$reservationEnd]);
        }
        if(Auth::user()->role_user_id == 3) {
            return redirect(route('reservation.getUserReservation'));
        }
        else {
            return redirect(route('reservation.index'));
        }
    }

    public function storePackageTour(ReservationStorePackageTourRequest $request)
    {
        //create the reservation instance object
        //initialize the sumPrice - for sum all the itineraries price
        //automate the user_id, reservation_status_id to pending, associate the itineraries/packagetour, durations
        //Note: reservation_type_id == 1 - Ground(activity). Else 2-full boat(packagetour)

        $sumPrice = 0;
        $input = $request -> all();
        $reservation = Reservation::create($input);
        $reservation->update(['user_id'=>Auth::user()->id, 'reservation_status_id'=>1]);
        $reservation->packageTour()->sync([$input['packagetour_id']]);                  //since package tour only receive string instead of array, must create an array bracket
        $packagetour = PackageTour::findOrFail($input['packagetour_id']);

        if($input['price_type'] == 'personal') {
            foreach($packagetour->prices as $price) {
                $sumPrice += $input['adult_no'] * $price->personal;
            }
        }
        else if($input['price_type'] == 'private_group') {
            foreach($packagetour->prices as $price) {
                $sumPrice += ($input['adult_no'] * $price->private_group_adult) + ($input['children_no'] * $price->private_group_children);
            }
        }
        else if($input['price_type'] == 'public_group') {
            foreach($packagetour->prices as $price) {
                $sumPrice += ($input['adult_no'] * $price->public_group_adult) + ($input['children_no'] * $price->public_group_children);
            }
        }

        $duration = $packagetour->duration;
        $trimDuration = $duration[0];
        $reservationEnd = Carbon::parse($reservation->reservation_start)->addDays($trimDuration)->toDateString();
        $reservation->update(['price' => $sumPrice, 'reservation_end'=>$reservationEnd]);
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

        $sumPrice = 0;
        $input = $request -> all();
        $reservation = Reservation::create($input);
        $reservation->update(['user_id'=>Auth::user()->id, 'reservation_status_id'=>1]);
        $reservation->itineraries()->sync([$input['itinerary_id']]);                  //since package tour only receive string instead of array, must create an array bracket
        $itinerary = Itinerary::findOrFail($input['itinerary_id']);

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

        $duration = $itinerary->duration;
        $trimDuration = $duration[0];
        $reservationEnd = Carbon::parse($reservation->reservation_start)->addDays($trimDuration)->toDateString();
        $reservation->update(['price' => $sumPrice, 'reservation_end'=>$reservationEnd]);
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
    {
        //
    }

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
        return view('reservation.showPackageTour', compact('reservation','packagetours', 'currency'));
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
        return view('reservation.showItinerary', compact('reservation', 'itineraries', 'currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //call the particular reservation
        //list out the itineraries and packagetours
        $i = 0;
        $reservation = Reservation::findOrFail($id);
        $itineraries = Itinerary::lists('name', 'id')->all();
        $packagetours = PackageTour::lists('name', 'id')->all();
        return view('reservation.edit', compact('reservation', 'itineraries', 'packagetours', 'i'));
    }

    public function editPackageTour($id)
    {
        $reservation = Reservation::findOrFail($id);
        if(session()->has('currencyCode')) {
            $currency = Currency::whereCode(session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        $packagetours = PackageTour::lists('name', 'id')->all();
        return view('reservation.editPackageTour', compact('reservation', 'itineraries', 'packagetours', 'currency'));
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
        $itineraries = Itinerary::lists('name', 'id')->all();
        return view('reservation.editItinerary', compact('reservation', 'itineraries', 'itineraries', 'currency'));
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
        $packagetours = PackageTour::lists('name', 'id')->all();
        $reservationStatusIds = ReservationStatus::lists('name', 'id')->all();
        return view('reservation.reviewPackageTour', compact('reservation', 'reservationStatusIds', 'packagetours', 'currency'));
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
        $itineraries = Itinerary::lists('name', 'id')->all();
        $reservationStatusIds = ReservationStatus::lists('name', 'id')->all();
        return view('reservation.reviewItinerary', compact('reservation', 'reservationStatusIds', 'itineraries', 'currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //pretty much similar to the store reservation
        //this updates the particular reservation
        $sumPrice = 0;
        $input = $request -> all();
        $reservation = Reservation::findOrFail($id);
        $reservation->update($input);
        if($input['reservation_type_id'] == 1) {                                                //if reservation type is ground
            $reservation->itineraries()->sync($input['itinerary_id']);
            $itineraries = Itinerary::findOrFail($input['itinerary_id']);
            $tempAddDays = 0;
            foreach ($itineraries as $itinerary) {
                $sumPrice += ($input['children_no'] * $itinerary->price_children) + ($input['adult_no'] * $itinerary->price_adult);

                $duration = $itinerary->duration;
                $trimDuration = $duration[0];
                $tempAddDays += $trimDuration;
            }
            $reservationEnd = Carbon::parse($reservation->reservation_start)->addDays($tempAddDays)->toDateString();
            $reservation->update(['price' => $sumPrice, 'reservation_end'=>$reservationEnd]);
        }
        else if($input['reservation_type_id'] == 2 ) {
            $reservation->packageTour()->sync([$input['packagetour_id']]);                  //since package tour only receive string instead of array, must create an array bracket
            $packagetour = PackageTour::findOrFail($input['packagetour_id']);

            $sumPrice += ($input['children_no'] * $packagetour->price_children) + ($input['adult_no'] * $packagetour->price_adult);

            $duration = $packagetour->duration;
            $trimDuration = $duration[0];
            $reservationEnd = Carbon::parse($reservation->reservation_start)->addDays($trimDuration)->toDateString();
            $reservation->update(['price' => $packagetour->$sumPrice, 'reservation_end'=>$reservationEnd]);
        }
        if(Auth::user()->role_user_id == 3) {
            return redirect(route('reservation.getUserReservation'));
        }
        else {
            return redirect(route('reservation.index'));
        }
    }

    public function updatePackageTour(ReservationUpdatePackageTourRequest $request, $id)
    {
        //pretty much similar to the store reservation
        //this updates the particular reservation
        $sumPrice = 0;
        $input = $request -> all();
        $reservation = Reservation::findOrFail($id);
        $reservation->update($input);
        $reservation->packageTour()->sync([$input['packagetour_id']]);                  //since package tour only receive string instead of array, must create an array bracket
        $packagetour = PackageTour::findOrFail($input['packagetour_id']);

        if($input['price_type'] == 'personal') {
            foreach($packagetour->prices as $price) {
                $sumPrice += $input['adult_no'] * $price->personal;
            }
        }
        else if($input['price_type'] == 'private_group') {
            foreach($packagetour->prices as $price) {
                $sumPrice += ($input['adult_no'] * $price->private_group_adult) + ($input['children_no'] * $price->private_group_children);
            }
        }
        else if($input['price_type'] == 'public_group') {
            foreach($packagetour->prices as $price) {
                $sumPrice += ($input['adult_no'] * $price->public_group_adult) + ($input['children_no'] * $price->public_group_children);
            }
        }

        $duration = $packagetour->duration;
        $trimDuration = $duration[0];
        $reservationEnd = Carbon::parse($reservation->reservation_start)->addDays($trimDuration)->toDateString();
        $reservation->update(['price' => $sumPrice, 'reservation_end'=>$reservationEnd]);
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
        $reservation->itineraries()->sync([$input['itinerary_id']]);                  //since package tour only receive string instead of array, must create an array bracket
        $itinerary = Itinerary::findOrFail($input['itinerary_id']);

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

        $duration = $itinerary->duration;
        $trimDuration = $duration[0];
        $reservationEnd = Carbon::parse($reservation->reservation_start)->addDays($trimDuration)->toDateString();
        $reservation->update(['price' => $sumPrice, 'reservation_end'=>$reservationEnd]);
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
        $reservation->update(['reservation_status_id'=>$input['reservation_status_id'], 'remarks'=>$input['remarks']]);
        return redirect(route('reservation.index'));
    }

    public function postReviewItinerary(ReservationReviewItineraryRequest $request, $id)
    {
        //pretty much similar to the store reservation
        //this updates the particular reservation
        $input = $request -> all();
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['reservation_status_id'=>$input['reservation_status_id'], 'remarks'=>$input['remarks']]);
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
        $reservation->packageTour()->detach();
        $reservation->itineraries()->detach();
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
//        Order::create([
//            'email' => Auth::user()->email,
//            'product' => $product_name
//        ]);

        return redirect()
            ->route('reservation.getUserReservation', compact('currency', 'reservations'))
            ->with('msg', 'Thanks for your purchase!');
    }
}
