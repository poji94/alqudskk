<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStorePackageTourRequest;
use App\Itinerary;
use App\PackageTour;
use App\Reservation;
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
        return view('reservation.index', compact('reservations'));
    }

    public function getUserReservation()
    {
        $reservations = Reservation::where('user_id', Auth::user()->id)->get();
        return view('reservation.index', compact('reservations'));
    }

    public function createPackageTour($id)
    {
        $i = 0;
        $reservedPackageTour = PackageTour::findOrFail($id);
        $packagetours = PackageTour::lists('name', 'id')->all();
//        $reservation = new Reservation();
//        $reservation->packageTour()->attach($id);
        return view('reservation.createPackageTour', compact('reservation', 'packagetours', 'reservedPackageTour', 'i'));
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

    public function store(ReservationStoreRequest $request)
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationStoreRequest $request, $id)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
}
