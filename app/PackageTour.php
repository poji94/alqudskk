<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageTour extends Model
{
    //setting mass assignments
    protected $fillable = ['name', 'description', 'duration', 'price_children', 'price_adult'];

    //many-to-many relationships itinerary <-> packagetour through itinerary_packagetour pivot table
    public function itineraries() {
        return $this->belongsToMany('App\Itinerary');
    }

    //many-to-many polymorphic relationship packagetour <-> placetourism through tourismable pivot table
    public function places() {
        return $this->morphToMany('App\PlaceTourism', 'tourismable');
    }

    //many-to-many polymorphic relationship packagetour <-> typevacation through typeable pivot table
    public function types() {
        return $this->morphToMany('App\TypeVacation', 'typeable');
    }

    //many-to-many polymorphic relationship packagetour <-> reservation through reservable pivot table
    public function reserves() {
        return $this->morphToMany('App\Reservation', 'reservable');
    }
}
