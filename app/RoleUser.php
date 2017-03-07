<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $fillable = ['name'];

    public function users() {
        return $this->belongsTo('App\User', 'id');
    }
}
