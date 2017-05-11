<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceTourism extends Model
{
    protected $fillable = ['personal', 'private_group_adult', 'private_group_children', 'public_group_adult', 'public_group_children'];

    //many-to-many polymorphic relationship pricetourism <-> packagetour through priceable pivot table
    public function packageTours() {
        return $this->morphedByMany('App\PackageTour', 'priceable');
    }
}
