<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageTour extends Model
{
    protected $fillable = ['name', 'description', 'duration', 'time'];

    public function itineraries() {
        return $this->belongsToMany('App\Itinerary');
    }
}
