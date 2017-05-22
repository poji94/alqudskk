<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //setting mass assignments
    protected $fillable = ['user_id', 'reservation_type_id', 'reservation_start', 'reservation_end',
                            'children_no', 'adult_no', 'price_type', 'price', 'reservation_status_id', 'remarks', 'remarks_by'];

    //one-to-one relationship reservation <-> user
    public function reserveUser() {
        return $this->belongsTo('App\User', 'user_id');
    }

    //one-to-one relationship reservation <-> reservationType
    public function reserveType() {
        return $this->belongsTo('App\ReservationType', 'reservation_type_id');
    }

    //one-to-one relationship reservation <-> reservationStatus
    public function reserveStatus() {
        return $this->belongsTo('App\ReservationStatus', 'reservation_status_id');
    }

    //many-to-many polymorphic relationship reservation <-> packgetour through reservable pivot table
    public function packageTour() {
        return $this->morphedByMany('App\PackageTour', 'reservable');
    }

    //many-to-many polymorphic relationship reservation <-> itinerary through reservable pivot table
    public function itineraries() {
        return $this->morphedByMany('App\Itinerary', 'reservable');
    }

    //accessor price attribute - adding rm infront
//    public function getPriceAttribute($value) {
//        return 'RM' . $value;
//    }
}
