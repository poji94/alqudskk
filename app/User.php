<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;
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

    //one-to-one relationship user <-> roleUser
    public function roleUser() {
        return $this->belongsTo('App\RoleUser', 'role_user_id');
    }

    //one-to-many inverse relationship user <-> reservations
    public function reservations() {
        return $this->hasMany('App\Reservation', 'id');
    }

    //setting the password attribute to be encrypted all the time
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    //set the initial character of the name becomes capital letter
    public function getNameAttribute($value) {
        return ucfirst($value);
    }
}
