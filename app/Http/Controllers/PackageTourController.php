<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageTourRequest;
use App\Itinerary;
use App\PackageTour;
use Illuminate\Http\Request;

use App\Http\Requests;

class PackageTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all objects of packagetour
        $packagetours = PackageTour::all();
        return view('packagetour.index', compact('packagetours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //list out all itineraries
        $itineraries = Itinerary::lists('name', 'id')->all();
        return view('packagetour.create', compact('itineraries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageTourRequest $request)
    {
        //creating the packagetour object, sync with associate itineraries, typevacation and placetourism
        $input = $request->all();
        $packagetour = PackageTour::create($input);
        $packagetour->itineraries()->sync($input['itinerary_id']);
        $packagetour->places()->detach();
        $packagetour->types()->detach();
        foreach($packagetour->itineraries as $itinerary) {
            foreach($itinerary->places as $place) {
                $packagetour->places()->save($place);
            }
            foreach($itinerary->types as $type) {
                $packagetour->types()->save($type);
            }
        }
        return redirect(route('packagetour.index'));
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
        //i used to control the count multi input field - for this case, itineraries
        //list out the itineraries
        //call out the particular packagetour
        $i = 0;
        $packagetour = PackageTour::findOrFail($id);
        $itineraries = Itinerary::lists('name', 'id')->all();
        return view('packagetour.edit', compact('packagetour', 'itineraries', 'i'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageTourRequest $request, $id)
    {
        //call out the particular packagetour object
        //update the information and sync with associate itineraries
        //update the typevacation and placetourism
        $packagetour = PackageTour::findOrFail($id);
        $input = $request -> all();
        $packagetour->update($input);
        $packagetour->itineraries()->sync($input['itinerary_id']);
        $packagetour->places()->detach();
        $packagetour->types()->detach();
        foreach($packagetour->itineraries as $itinerary) {
            foreach($itinerary->places as $place) {
                $packagetour->places()->save($place);
            }
            foreach($itinerary->types as $type) {
                $packagetour->types()->save($type);
            }
        }
        return redirect(route('packagetour.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete everything relate to particular packagetour
        $packagetour = PackageTour::findOrFail($id);
        $packagetour->delete();
        $packagetour->itineraries()->detach();
        $packagetour->places()->detach();
        $packagetour->types()->detach();
        return redirect(route('packagetour.index'));
    }
}
