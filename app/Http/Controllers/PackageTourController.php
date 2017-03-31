<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageTourStoreRequest;
use App\Http\Requests\PackageTourUpdateRequest;
use App\Itinerary;
use App\PackageTour;
use App\PlaceTourism;
use App\TypeVacation;
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

    public function getSelection()
    {
        $isItinerary = false;
        $selectedPackageTours = PackageTour::all();
        $placetourism = PlaceTourism::lists('name', 'id')->all();
        $typevacation = TypeVacation::lists('name', 'id')->all();
        return view('packagetour.filter', compact('selectedPackageTours', 'placetourism', 'typevacation', 'isItinerary'));
    }

    public function filterSelection(Request $request)
    {
        $selectedPackageTours = array();
        $input = $request->all();
        $packageTours = PackageTour::all();
        if($input['place_tourism'] == null && $input['type_vacation'] == null) {
            $selectedItineraries = $packageTours;
        }
        else if ($input['place_tourism'] == null ) {
            foreach($packageTours as $packageTour) {
                foreach($packageTour->types as $type) {
                    if($type->pivot->type_vacation_id == $input['type_vacation']) {
                        $selectedPackageTours = $type->packageTours;
                    }
                }
            }
        }
        else if($input['type_vacation'] == null) {
            foreach($packageTours as $packageTour) {
                foreach($packageTour->places as $place) {
                    if($place->pivot->place_tourism_id == $input['place_tourism']) {
                        $selectedPackageTours = $place->packageTours;
                    }
                }
            }
        }
        else {
            foreach($packageTours as $packageTour) {
                foreach($packageTour->places as $place) {
                    if($place->pivot->place_tourism_id == $input['place_tourism']) {
                        $filtered1PackageTours = $place->packageTours;
                    }
                }
            }
            foreach($filtered1PackageTours as $filtered1PackageTour) {
                foreach($filtered1PackageTour->types as $type) {
                    if($type->pivot->type_vacation_id == $input['type_vacation']) {
                        $selectedPackageTours = PackageTour::findOrFail($type->pivot->typeable_id);
                    }
                }
            }
        }
        $placetourism = PlaceTourism::lists('name', 'id')->all();
        $typevacation = TypeVacation::lists('name', 'id')->all();
        return view('packagetour.filter', compact('selectedPackageTours', 'placetourism', 'typevacation'));
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
    public function store(PackageTourStoreRequest $request)
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
        $packageTour = PackageTour::findOrFail($id);
        foreach($packageTour->types as $type) {
            if($type->pivot->type_vacation_id == $packageTour->types->first()->id) {
                $selectedTypePackageTours = $type->packageTours;
            }
        }
        foreach($packageTour->places as $place) {
            if($place->pivot->place_tourism_id == $packageTour->places->first()->id) {
                $selectedPlacePackageTours = $place->packageTours;
            }
        }
        return view('packagetour.show', compact('packageTour', 'selectedTypePackageTours', 'selectedPlacePackageTours'));
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
    public function update(PackageTourUpdateRequest $request, $id)
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
