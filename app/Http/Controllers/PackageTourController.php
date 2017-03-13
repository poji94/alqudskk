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
//        return $request->all();
        //        return $count;

        $input = $request -> all();
        PackageTour::create($input);
        $count = $input['count'];
//        PackageTourController::createItineraries($input['name'], $count);
        $packagetour = PackageTour::whereName($input['name'])->orderBy('created_at', 'desc')->first();
        $itineraries = Itinerary::lists('name', 'id')->all();
        return view('packagetour.createItinerary', compact('itineraries', 'packagetour', 'count'));

//        return redirect(route('packagetour.index'));
//        $packagetour = PackageTour::whereName($input['name'])->orderBy('created_at', 'desc')->first();

//        $input = $request -> all();
//        $i = 1;
//        $count = 3;
//        PackageTour::create($input);
//        $packagetour = PackageTour::whereName($input['name'])->orderBy('created_at', 'desc')->first();
//        if($input['itinerary_id']) {
//            $packagetour->itineraries()->attach($input['itinerary_id']);
//        }
//        for($i = 1; $i < $count; $i++) {
//            $packagetour->itineraries()->attach($input['itinerary_id'] . $i);
//        }
//        return redirect(route('packagetour.index'));
    }

//    public function createItineraries($name, $count) {
//        $packagetour = PackageTour::whereName($name)->orderBy('created_at', 'desc')->first();
//        $itineraries = Itinerary::lists('name', 'id')->all();
//        return view('packagetour.createItinerary', compact('itineraries', $tourpackage, $count));
//    }

    public function storeItineraries(Request $request)
    {
        $input = $request->all();
        $packagetour = PackageTour::findOrFail($input['id']);
        $packagetour->itineraries()->detach();
        for($i = 0; $i < $input['count']; $i++) {
            $packagetour->itineraries()->attach($input['itinerary_id' . $i]);
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
        $packagetour = PackageTour::findOrFail($id);
        $itinerariesAssoc = $packagetour->itineraries;
        $itineraries = Itinerary::lists('name', 'id')->all();
        return view('packagetour.edit', compact('packagetour', 'itineraries', 'itinerariesAssoc'));
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
        $packagetour->itineraries()->sync([$input['itinerary_id']]);
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
        $packagetour = PackageTour::findOrFail($id);
        $packagetour->delete();
        $packagetour->itineraries()->detach();
        return redirect(route('packagetour.index'));
    }
}
