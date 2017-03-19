<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //setting mass assignments
    protected $fillable = ['path'];

    protected $uploads = '/media/';

    //polymorphic relationship between media to other table - itinerary for now
    public function imageable() {
        return $this->morphTo();
    }

    //accessor the path attributes to add string uploads infront
    public function getPathAttribute($media) {
        return $this->uploads . $media;
    }

}
