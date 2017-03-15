<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceTourism extends Model
{
    public function itineraries() {
        return $this->morphedByMany('App\Itinerary', 'tourismable');
    }

    public function packageTours() {
        return $this->morphedByMany('App\PackageTour', 'tourismable');
    }
}
