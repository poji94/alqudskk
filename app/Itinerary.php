<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    //setting mass assignments
    protected $fillable = ['name', 'description', 'duration'];

    //many-to-many relationship itinerary <-> packagetour through itinerary_packagetour pivot table
    public function packagesTours() {
        return $this->belongsToMany('App\PackageTour');
    }

    //many-to-many polymorphic relationship itinerary <-> placetourism through tourismable pivot table
    public function places() {
        return $this->morphToMany('App\PlaceTourism', 'tourismable');
    }

    //many-to-many polymorphic relationship itinerary <-> typevacation through typeable pivot table
    public function types() {
        return $this->morphToMany('App\TypeVacation', 'typeable');
    }

    //many-to-many polymorphic relationship itinerary <-> pricetourism through priceable pivot table
    public function prices() {
        return $this->morphToMany('App\PriceTourism', 'priceable');
    }

    //polymorhpic relationship itinerary <-> media
    public function medias() {
        return $this->morphMany('App\Media', 'imageable');
    }

    //many-to-many polymorphic relationship itinerary <-> reservation through reservable pivot table
    public function reserves() {
        return $this->morphToMany('App\Reservation', 'reservable');
    }
}
