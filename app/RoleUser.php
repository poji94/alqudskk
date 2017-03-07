<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    // Set up fillable variable for mass assignment
    protected $fillable = ['name'];

    //set up reverse relationship for uUer<->RoleUser
    public function users() {
        return $this->hasOne('App\User', 'id');
    }
}
