<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class RetailerCityAgency extends Model
{
    protected $table = 'ad_retailer_city_agencies';

    public function retailerCity()
    {
        return $this->belongsTo(RetailerCity::class, 'ad_retailer_city_id', 'id');
    }

}
