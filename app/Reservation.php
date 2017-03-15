<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'reservation_type_id', 'reservation_start', 'reservation_end',
                            'price', 'reservation_status_id'];

    public function reserveUser() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function reserveType() {
        return $this->belongsTo('App\ReservationType', 'reservation_type_id');
    }

    public function reserveStatus() {
        return $this->belongsTo('App\ReservationStatus', 'reservation_status_id');
    }
}
