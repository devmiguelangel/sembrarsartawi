<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'ad_agencies';

    public function retailerCityAgencies()
    {
        return $this->hasMany(RetailerCityAgency::class, 'ad_agency_id', 'id');
    }

}
