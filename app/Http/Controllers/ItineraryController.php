<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItineraryRequest;
use App\Itinerary;
use App\PlaceTourism;
use App\TypeVacation;
use Illuminate\Http\Request;

use App\Http\Requests;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //getting all the data from itinerary data table
    public function index()
    {
        $itineraries = Itinerary::all();
        return view('itinerary.index', compact('itineraries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //create an itinerary by showing create form
    public function create()
    {
        $placetourism = PlaceTourism::lists('name', 'id')->all();
        $typevacation = TypeVacation::lists('name', 'id')->all();
        return view('itinerary.create', compact('placetourism', 'typevacation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //store the itinerary from the create() process
    public function store(ItineraryRequest $request)
    {
        $input = $request -> all();
        $itinerary = Itinerary::create($input);
        $placetourism = PlaceTourism::findOrFail($input['place_tourism']);
        $typevacation = TypeVacation::findOrFail($input['type_vacation']);
        $itinerary->places()->save($placetourism);
        $itinerary->types()->save($typevacation);
        return redirect(route('itinerary.index'));
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

    //edit the itinerary by showing edit form
    public function edit($id)
    {
        $itinerary = Itinerary::findOrFail($id);
        foreach ($itinerary->places as $place) {
            $place_tourism = $place->pivot->place_tourism_id;
        }
        foreach ($itinerary->types as $type) {
            $type_vacation = $type->pivot->type_vacation_id;
        }
        $placetourism = PlaceTourism::lists('name', 'id')->all();
        $typevacation = TypeVacation::lists('name', 'id')->all();
        return view('itinerary.edit', compact('itinerary', 'placetourism', 'place_tourism', 'typevacation', 'type_vacation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //store the itinerary from the create() process
    public function update(ItineraryRequest $request, $id)
    {
        $itinerary = Itinerary::findOrFail($id);
        $input = $request -> all();
        $itinerary->update($input);
        $placetourism = PlaceTourism::findOrFail($input['place_tourism']);
        $typevacation = TypeVacation::findOrFail($input['type_vacation']);
        $itinerary->places()->detach();
        $itinerary->places()->save($placetourism);
        $itinerary->types()->detach();
        $itinerary->types()->save($typevacation);
        return redirect(route('itinerary.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //delete the itinerary from itinerary data table
    public function destroy($id)
    {
        $itinerary = Itinerary::findOrFail($id);
        $itinerary->delete();
        $itinerary->places()->detach();
        $itinerary->types()->detach();
        return redirect(route('itinerary.index'));
    }
}
