<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'ad_cities';

    public function retailerCities()
    {
        return $this->hasMany(RetailerCity::class, 'ad_city_id', 'id');
    }

}
