<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationType extends Model
{
    public function reserves() {
        return $this->hasOne('App\Reservation', 'id');
    }
}
