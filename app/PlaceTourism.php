<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceTourism extends Model
{
    //many-to-many polymorphic relationship placetourism <-> itinerary through tourismable pivot table
    public function itineraries() {
        return $this->morphedByMany('App\Itinerary', 'tourismable');
    }

    //many-to-many polymorphic relationship placetourism <-> packagetour through tourismable pivot table
    public function packageTours() {
        return $this->morphedByMany('App\PackageTour', 'tourismable');
    }
}
