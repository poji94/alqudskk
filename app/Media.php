<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['path'];

    protected $uploads = '/media/';

    public function getPathAttribute($media) {
        return $this->uploads . $media;
    }

    public function imageable() {
        return $this->morphTo();
    }
}
