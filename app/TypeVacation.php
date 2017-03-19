<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeVacation extends Model
{
    //many-to-many polymorphic relationship itinerary <-> typevacation through typeable pivot table
    public function itineraries() {
        return $this->morphedByMany('App\Itinerary', 'typeable');
    }

    //many-to-many polymorphic relationship packgetour <-> typevacation through typeable pivot table
    public function packageTours() {
        return $this->morphedByMany('App\PackageTour', 'typeable');
    }
}
