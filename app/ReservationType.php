<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationType extends Model
{
    //inverse one-to-one relationship reservation <-> reservationType
    public function reserves() {
        return $this->hasOne('App\Reservation', 'id');
    }
}
