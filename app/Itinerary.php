<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $fillable = ['name', 'description', 'duration', 'price'];

    public function packagesTours() {
        return $this->belongsToMany('App\PackageTour');
    }

    public function places() {
        return $this->morphToMany('App\PlaceTourism', 'tourismable');
    }

    public function types() {
        return $this->morphToMany('App\TypeVacation', 'typeable');
    }

    public function medias() {
        return $this->morphMany('App\Media', 'imageable');
    }

}
