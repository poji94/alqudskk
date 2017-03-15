<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageTour extends Model
{
    protected $fillable = ['name', 'description', 'itineraries_number', 'duration', 'price'];

    public function itineraries() {
        return $this->belongsToMany('App\Itinerary');
    }

    public function places() {
        return $this->morphToMany('App\PlaceTourism', 'tourismable');
    }

    public function types() {
        return $this->morphToMany('App\TypeVacation', 'typeable');
    }

    public function reserves() {
        return $this->morphToMany('App\Reservation', 'reservable');
    }
}
