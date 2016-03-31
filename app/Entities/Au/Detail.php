<?php

namespace Sibas\Entities\Au;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{

    protected $table = 'op_au_details';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'op_au_header_id',
        'ad_vehicle_type_id',
        'ad_vehicle_make_id',
        'ad_vehicle_model_id',
        'category',
        'year',
        'license_plate',
        'use',
        'traction',
        'mileage',
        'color',
        'engine',
        'chassis',
        'tonnage_capacity',
        'seat_number',
        'insured_value',
        'rate',
        'premium',
        'approved',
        'rejected',
        'file',
    ];


    public function setLicensePlateAttribute($value)
    {
        $this->attributes['license_plate'] = strtoupper($value);
    }
}
