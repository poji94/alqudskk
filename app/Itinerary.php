<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $fillable = ['name', 'description', 'duration', 'time'];

    public function packagesTours() {
        return $this->belongsToMany('App\PackageTour');
    }
}
