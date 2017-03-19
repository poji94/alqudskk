<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    //inverse  one-to-one relationship reservation <-> reservationStatus
    public function reserves() {
        return $this->hasOne('App\Reservation', 'id');
    }
}
