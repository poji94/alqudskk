<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeVacation extends Model
{
    public function itineraries() {
        return $this->morphedByMany('App\Itinerary', 'typeable');
    }

    public function packageTours() {
        return $this->morphedByMany('App\PackageTour', 'typeable');
    }
}
