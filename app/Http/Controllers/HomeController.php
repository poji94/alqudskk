<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Itinerary;
use App\PackageTour;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itineraries = Itinerary::inRandomOrder()->limit(4)->get();
        $packageTours = PackageTour::inRandomOrder()->limit(4)->get();
        return view('welcome', compact('itineraries', 'packageTours'));
    }
}
