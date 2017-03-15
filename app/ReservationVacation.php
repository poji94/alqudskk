<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationVacation extends Model
{
    public function reservable() {
        return $this->morphTo();
    }
}
