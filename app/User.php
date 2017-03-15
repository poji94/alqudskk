<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //setting mass assignment
    protected $fillable = [
        'name', 'email', 'password', 'role_user_id', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //setting relationship
    public function roleUser() {
        return $this->belongsTo('App\RoleUser', 'role_user_id');
    }

    public function reservations() {
        return $this->hasMany('App\Reservation', 'id');
    }

    //setting the password attribute to be encrypted all the time
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }
}
