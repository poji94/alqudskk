<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItineraryStoreRequest;
use App\Http\Requests\ItineraryUpdateRequest;
use App\Itinerary;
use App\PlaceTourism;
use App\TypeVacation;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
        $itineraries = Itinerary::all();
        $placetourism = PlaceTourism::lists('name', 'id')->all();
        $typevacation = TypeVacation::lists('name', 'id')->all();
        return view('vacation.index', compact('itineraries', 'placetourism', 'typevacation'));
//        return url()->current();
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
        $placetourism = PlaceTourism::findOrFail($input['place_tourism']);
        $typevacation = TypeVacation::findOrFail($input['type_vacation']);
        $itinerary->places()->save($placetourism);
        $itinerary->types()->save($typevacation);
        if($medias = $request->file('media_id')) {
            $i = 0;
            foreach($medias as $media) {
                $name = 'photo_' . $itinerary->name . '_' . $i . '.' . $media->getClientOriginalExtension();
                $media->move('media', $name);
                $itinerary->medias()->create(['path' => $name]);
                $i++;
            }
        }
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
        //getting the placetourism and typevacation and itineraries of particular object
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
    public function update(ItineraryUpdateRequest $request, $id)
    {
        //get again the object of particular itineraries, tagging typevacation and placetourism and relate with pictures
        $itinerary = Itinerary::findOrFail($id);
        $input = $request -> all();
        $itinerary->update($input);

        $placetourism = PlaceTourism::findOrFail($input['place_tourism']);
        $typevacation = TypeVacation::findOrFail($input['type_vacation']);
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
        $itinerary->places()->detach();
        $itinerary->types()->detach();
        foreach($itinerary->medias as $media) {
            unlink(public_path(). $media->path);
        }
        $itinerary->medias()->delete();
        return redirect(route('itinerary.index'));
    }
}
