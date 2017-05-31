<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItineraryStoreRequest;
use App\Http\Requests\ItineraryUpdateRequest;
use App\Itinerary;
use App\PlaceTourism;
use App\TypeVacation;
use App\Currency;

use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

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
        //getting all object of itineraries
        $itineraries = Itinerary::all();
        return view('itinerary.index', compact('itineraries'));
    }

    public function getSelection()
    {
        $selectedItineraries = Itinerary::all();
        $placetourism = PlaceTourism::lists('name', 'id')->all();
        $typevacation = TypeVacation::lists('name', 'id')->all();
        return view('itinerary.filter', compact('selectedItineraries', 'placetourism', 'typevacation'));
    }

    public function filterSelection(Request $request)
    {
        $selectedItineraries = array();
        $input = $request->all();
        $itineraries = Itinerary::all();
        if($input['place_tourism'] == null && $input['type_vacation'] == null) {
            $selectedItineraries = $itineraries;
        }
        else if ($input['place_tourism'] == null ) {
            foreach($itineraries as $itinerary) {
                foreach($itinerary->types as $type) {
                    if($type->pivot->type_vacation_id == $input['type_vacation']) {
                        $selectedItineraries = $type->itineraries;
                    }
                }
            }
        }
        else if($input['type_vacation'] == null) {
            foreach($itineraries as $itinerary) {
                foreach($itinerary->places as $place) {
                    if($place->pivot->place_tourism_id == $input['place_tourism']) {
                        $selectedItineraries = $place->itineraries;
                    }
                }
            }
        }
        else {
            foreach($itineraries as $itinerary) {
                foreach($itinerary->places as $place) {
                    if($place->pivot->place_tourism_id == $input['place_tourism']) {
                        $filtered1Itineraries = $place->itineraries;
                    }
                }
            }
            foreach($filtered1Itineraries as $filtered1Itinerary) {
                foreach($filtered1Itinerary->types as $type) {
                    if($type->pivot->type_vacation_id == $input['type_vacation']) {
                        $selectedItineraries = Itinerary::findOrFail($type->pivot->typeable_id);
                    }
                }
            }
        }
        $placetourism = PlaceTourism::lists('name', 'id')->all();
        $typevacation = TypeVacation::lists('name', 'id')->all();
        return view('itinerary.filter', compact('selectedItineraries', 'placetourism', 'typevacation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //create an itinerary by showing create form
    public function create()
    {
        //list out all placetourism and typevacation
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
    public function store(ItineraryStoreRequest $request)
    {
        //creating itinerary object, tagging placetourism and typevacation and also relate itineraries with pictures
        $input = $request -> all();
        $itinerary = Itinerary::create($input);
        $itinerary->prices()->create($input);
        $placetourism = PlaceTourism::findOrFail($input['place_tourism']);
        $typevacation = TypeVacation::findOrFail($input['type_vacation']);
        if($medias = $request->file('media_id')) {
            $i = 0;
            foreach($medias as $media) {
                $name = 'photo_' . $itinerary->name . '_' . $i . '.' . $media->getClientOriginalExtension();
                $media->move('media', $name);
                $itinerary->medias()->create(['path' => $name]);
                $i++;
            }
        }

        $duration = $itinerary->duration;

        $option1DropOffTime = Carbon::parse($itinerary->option1_pickup_time)->addHours($duration)->toTimeString();
        $option1PickupTime = Carbon::parse($itinerary->option1_pickup_time)->format('g:i A');
        $option1DropOffTime = Carbon::parse($option1DropOffTime)->format('g:i A');
        $itinerary->update(['option1_pickup_time'=>$option1PickupTime, 'option1_dropoff_time'=>$option1DropOffTime]);

        if($input['option2_pickup_time'] != null) {
            $option2DropOffTime = Carbon::parse($itinerary->option2_pickup_time)->addHours($duration)->toTimeString();
            $option2PickupTime = Carbon::parse($itinerary->option2_pickup_time)->format('g:i A');
            $option2DropOffTime = Carbon::parse($option2DropOffTime)->format('g:i A');
            $itinerary->update(['option2_pickup_time'=>$option2PickupTime, 'option2_dropoff_time'=>$option2DropOffTime]);
        }

        $itinerary->places()->save($placetourism);
        $itinerary->types()->save($typevacation);

        Session::flash('created_itinerary', 'Activity ' . $itinerary->name . ' successfully created');
        return redirect(route('itinerary.index'));
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

        $itinerary = Itinerary::findOrFail($id);
        foreach($itinerary->types as $type) {
            if($type->pivot->type_vacation_id == $itinerary->types->first()->id) {
                $selectedTypeItineraries = $type->itineraries;
            }
        }
        foreach($itinerary->places as $place) {
            if($place->pivot->place_tourism_id == $itinerary->places->first()->id) {
                $selectedPlaceItineraries = $place->itineraries;
            }
        }
        return view('itinerary.show', compact('currency', 'currencies', 'itinerary', 'selectedTypeItineraries', 'selectedPlaceItineraries'));
    }

    public function changeCurrency(Request $request)
    {
        $input = $request->all();
        $currencies = Currency::lists('name', 'id')->all();
        $itinerary = Itinerary::findOrFail($input['id']);
        if ($input['currency_drop_down'] == currency()->id) {
            $currency = Currency::whereCode(currency()->config('default'))->first();
        } else {
            $currency = Currency::findOrFail($input['currency_drop_down']);
        }
        $request->session()->put('currencyCode', $currency->code);

        foreach($itinerary->types as $type) {
            if($type->pivot->type_vacation_id == $itinerary->types->first()->id) {
                $selectedTypeItineraries = $type->itineraries;
            }
        }
        foreach($itinerary->places as $place) {
            if($place->pivot->place_tourism_id == $itinerary->places->first()->id) {
                $selectedPlaceItineraries = $place->itineraries;
            }
        }
        return view('itinerary.show', compact('currencies', 'currency', 'itinerary', 'selectedTypeItineraries', 'selectedPlaceItineraries'));
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
        //getting the placetourism and typevacation and itineraries of particular object
        $itinerary = Itinerary::findOrFail($id);
        foreach ($itinerary->places as $place) {
            $place_tourism = $place->pivot->place_tourism_id;
        }
        foreach ($itinerary->types as $type) {
            $type_vacation = $type->pivot->type_vacation_id;
        }

        $itinerary->option1_pickup_time = Carbon::parse($itinerary->option1_pickup_time)->format('H:i');
        $itinerary->option1_pickup_time = Carbon::parse($itinerary->option1_pickup_time)->format('H:i');

        if($itinerary->option2_pickup_time != null) {
            $itinerary->option2_pickup_time = Carbon::parse($itinerary->option2_pickup_time)->format('H:i');
            $itinerary->option2_pickup_time = Carbon::parse($itinerary->option2_pickup_time)->format('H:i');
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
    public function update(ItineraryUpdateRequest $request, $id)
    {
        //get again the object of particular itineraries, tagging typevacation and placetourism and relate with pictures
        $itinerary = Itinerary::findOrFail($id);
        $input = $request -> all();
        $itinerary->update($input);

        $placetourism = PlaceTourism::findOrFail($input['place_tourism']);
        $typevacation = TypeVacation::findOrFail($input['type_vacation']);
        $itinerary->prices()->delete();
        $itinerary->prices()->detach();
        $itinerary->prices()->create($input);
        $itinerary->places()->detach();
        $itinerary->types()->detach();
        $itinerary->places()->save($placetourism);
        $itinerary->types()->save($typevacation);

        foreach($itinerary->medias as $media) {
            unlink(public_path(). $media->path);
        }
        $itinerary->medias()->delete();
        if($files = $request->file('media_id')) {
                $i = 0;
            foreach($files as $file) {
                $name = 'photo_' . $itinerary->name . '_' . $i . '.' . $file->getClientOriginalExtension();
                $file->move('media', $name);
                $itinerary->medias()->create(['path' => $name]);
                $i++;
            }
        }

        $duration = $itinerary->duration;

        $option1DropOffTime = Carbon::parse($itinerary->option1_pickup_time)->addHours($duration)->toTimeString();
        $option1PickupTime = Carbon::parse($itinerary->option1_pickup_time)->format('g:i A');
        $option1DropOffTime = Carbon::parse($option1DropOffTime)->format('g:i A');
        $itinerary->update(['option1_pickup_time'=>$option1PickupTime, 'option1_dropoff_time'=>$option1DropOffTime]);

        if($input['option2_pickup_time'] != null) {
            $option2DropOffTime = Carbon::parse($itinerary->option2_pickup_time)->addHours($duration)->toTimeString();
            $option2PickupTime = Carbon::parse($itinerary->option2_pickup_time)->format('g:i A');
            $option2DropOffTime = Carbon::parse($option2DropOffTime)->format('g:i A');
            $itinerary->update(['option2_pickup_time'=>$option2PickupTime, 'option2_dropoff_time'=>$option2DropOffTime]);
        }

        Session::flash('updated_itinerary', 'Activity ' . $itinerary->name . ' successfully updated');
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
        //delete everything relate to the particular object of itineraries
        $itinerary = Itinerary::findOrFail($id);
        $itinerary->delete();
        $itinerary->prices()->delete();
        $itinerary->prices()->detach();
        $itinerary->places()->detach();
        $itinerary->types()->detach();
        foreach($itinerary->medias as $media) {
            unlink(public_path(). $media->path);
        }
        $itinerary->medias()->delete();

        Session::flash('deleted_itinerary', 'Activity ' . $itinerary->name . ' successfully deleted');
        return redirect(route('itinerary.index'));
    }
}
