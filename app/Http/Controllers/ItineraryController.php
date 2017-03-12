<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItineraryRequest;
use App\Itinerary;
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
        return view('itinerary.index', compact('itineraries'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //create an itinerary by showing create form
    public function create()
    {
        return view('itinerary.create');
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
        Itinerary::create($input);
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
        return view('itinerary.edit', compact('itinerary'));
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
        return redirect(route('itinerary.index'));
    }
}
