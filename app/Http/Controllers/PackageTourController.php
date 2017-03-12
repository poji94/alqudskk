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
        $input = $request -> all();
        PackageTour::create($input);
        $packagetour = PackageTour::whereName($input['name'])->first();
        $packagetour->itineraries()->sync([$input['itinerary_id']]);
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
