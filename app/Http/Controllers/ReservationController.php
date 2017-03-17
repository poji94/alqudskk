<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Itinerary;
use App\PackageTour;
use App\Reservation;
use App\ReservationStatus;
use App\ReservationType;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $reservations = Reservation::all();
        return view('reservation.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
    public function store(ReservationStoreRequest $request)
    {
        $sumPrice = 0;
        $input = $request -> all();
        $reservation = Reservation::create($input);
        $reservation->update(['user_id'=>Auth::user()->id, 'reservation_status_id'=>1]);            //automatically set user as logged in user and pending status reservation
        if($input['reservation_type_id'] == 1) {                                                //if reservation type is ground
            $reservation->itineraries()->sync($input['itinerary_id']);
            $itineraries = Itinerary::findOrFail($input['itinerary_id']);
            $tempAddDays = 0;
            foreach ($itineraries as $itinerary) {
                $sumPrice += $itinerary->price;

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

            $duration = $packagetour->duration;
            $trimDuration = $duration[0];
            $reservationEnd = Carbon::parse($reservation->reservation_start)->addDays($trimDuration)->toDateString();
            $reservation->update(['price' => $packagetour->price, 'reservation_end'=>$reservationEnd]);
        }
        return redirect(route('reservation.index'));
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
        $reservation = Reservation::findOrFail($id);
        $itineraries = Itinerary::lists('name', 'id')->all();
        $packagetours = PackageTour::lists('name', 'id')->all();
        return view('reservation.edit', compact('reservation'));
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
        $input = $request -> all();
        $reservation = Reservation::findOrFail($id);
        $reservation->update($input);
        $packagetours = PackageTour::lists('name', 'id')->all();
        $itineraries = Itinerary::lists('name', 'id')->all();
        return view('reservation.createReservationVacation', compact('reservation', 'packagetours', 'itineraries'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        $reservation->packageTour()->detach();
        $reservation->itineraries()->detach();
        return redirect(route('reservation.index'));
    }
}
