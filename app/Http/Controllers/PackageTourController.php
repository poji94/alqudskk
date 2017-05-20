<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Requests\PackageTourStoreRequest;
use App\Http\Requests\PackageTourUpdateRequest;
use App\Itinerary;
use App\PackageTour;
use App\PlaceTourism;
use App\PriceTourism;
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
            $selectedPackageTours = $packageTours;
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
        $packagetour->prices()->create($input);
        $packagetour->itineraries()->sync($input['itinerary_id']);
        $packagetour->places()->detach();
        $packagetour->types()->detach();
        if($medias = $request->file('media_id')) {
            $i = 0;
            foreach($medias as $media) {
                $name = 'photo_' . $packagetour->name . '_' . $i . '.' . $media->getClientOriginalExtension();
                $media->move('media', $name);
                $packagetour->medias()->create(['path' => $name]);
                $i++;
            }
        }
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
    public function show(Request $request, $id)
    {
        $currencies = Currency::lists('name', 'id')->all();
        if($request->session()->has('currencyCode')) {
            $currency = Currency::whereCode($request->session()->get('currencyCode'))->first();
        }
        else {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }

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
        return view('packagetour.show', compact('currencies', 'currency', 'packageTour', 'selectedTypePackageTours', 'selectedPlacePackageTours'));
    }

    public function changeCurrency(Request $request)
    {
        $input = $request->all();
        $currencies = Currency::lists('name', 'id')->all();
        $packageTour = PackageTour::findOrFail($input['id']);
        if($input['currency_drop_down'] == currency()->id) {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        }
        else {
            $currency = Currency::findOrFail($input['currency_drop_down']);
        }
        $request->session()->put('currencyCode', $currency->code);

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
        return view('packagetour.show', compact('currencies', 'currency', 'packageTour', 'selectedTypePackageTours', 'selectedPlacePackageTours'));
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
        $packageTour = PackageTour::findOrFail($id);
        $itineraries = Itinerary::lists('name', 'id')->all();
        return view('packagetour.edit', compact('packageTour', 'itineraries', 'i'));
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
        $packagetour->prices()->delete();
        $packagetour->prices()->detach();
        $packagetour->prices()->create($input);
        $packagetour->itineraries()->sync($input['itinerary_id']);
        $packagetour->places()->detach();
        $packagetour->types()->detach();

        foreach($packagetour->medias as $media) {
            unlink(public_path(). $media->path);
        }
        $packagetour->medias()->delete();
        if($files = $request->file('media_id')) {
            $i = 0;
            foreach($files as $file) {
                $name = 'photo_' . $packagetour->name . '_' . $i . '.' . $file->getClientOriginalExtension();
                $file->move('media', $name);
                $packagetour->medias()->create(['path' => $name]);
                $i++;
            }
        }
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
        $packagetour->prices()->delete();
        $packagetour->prices()->detach();
        $packagetour->itineraries()->detach();
        foreach($packagetour->medias as $media) {
            unlink(public_path(). $media->path);
        }
        $packagetour->medias()->delete();
        $packagetour->places()->detach();
        $packagetour->types()->detach();
        return redirect(route('packagetour.index'));
    }
}
