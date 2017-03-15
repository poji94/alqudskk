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
        return view('packagetour.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageTourRequest $request)
    {
        $input = $request->all();
        $packagetour = PackageTour::create($input);
        $itineraries = Itinerary::lists('name', 'id')->all();
        return view('packagetour.createItineraries', compact('itineraries', 'packagetour'));
    }

    public function storeItineraries(Request $request)
    {
        $input = $request->all();
        $packagetour = PackageTour::findOrFail($input['id']);
        $packagetour->itineraries()->detach();
        $packagetour->places()->detach();
        $packagetour->types()->detach();
        for($i = 0; $i < $packagetour->itineraries_number; $i++) {
            $packagetour->itineraries()->attach($input['itinerary_id' . $i]);
            $itinerary = Itinerary::findOrFail($input['itinerary_id'. $i]);
            echo $itinerary->places;
            foreach($itinerary->places as $place) {
                $packagetour->places()->save($place);
            }
            foreach($itinerary->types as $type) {
                $packagetour->types()->save($type);
            }
        }
//        foreach($packagetour->itineraries as $itinerary) {
//            foreach ($itinerary->places as $place) {
//                $packagetour->places()->save($place);
//            }
//            foreach ($itinerary->types as $type) {
//                $packagetour->types()->save($type);
//            }
//        }
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
        $packagetour = PackageTour::findOrFail($id);
        $itineraries = Itinerary::lists('name', 'id')->all();
        return view('packagetour.edit', compact('packagetour', 'itineraries'));
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
        $packagetour = PackageTour::findOrFail($id);
        $input = $request -> all();
        $packagetour->update($input);
        $itineraries = Itinerary::lists('name', 'id')->all();
        return view('packagetour.createItineraries', compact('itineraries', 'packagetour'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $packagetour = PackageTour::findOrFail($id);
        $packagetour->delete();
        $packagetour->itineraries()->detach();
        $packagetour->places()->detach();
        $packagetour->types()->detach();
        return redirect(route('packagetour.index'));
    }
}
