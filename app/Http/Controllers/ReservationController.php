<?php

namespace App\Http\Controllers;

use App\Itinerary;
use App\PackageTour;
use App\Reservation;
use App\ReservationStatus;
use App\ReservationType;
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
        return view('reservation.create', compact('reserveType', 'reserveStatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request -> all();
        $reservation = Reservation::create($input);
        $reservation->update(['user_id'=>Auth::user()->id, 'reservation_status_id'=>1]);
        $packagetours = PackageTour::lists('name', 'id')->all();
        $itineraries = Itinerary::lists('name', 'id')->all();
        return view('reservation.createReservationVacation', compact('reservation', 'packagetours', 'itineraries'));
    }

    public function storeReservationVacation(Request $request)
    {
        $input = $request->all();
        $reservation = Reservation::findOrFail($input['id']);
        $reservation->reserveVacations()->delete();
        if($reservation->reservation_type_id == 2) {
            $packagetour = PackageTour::findOrFail($input['package_tour_id']);
            $reservation->reserveVacations()->save($packagetour);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
