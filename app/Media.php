<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['path'];

    public function imageable() {
        return $this->morphTo();
    }
}
