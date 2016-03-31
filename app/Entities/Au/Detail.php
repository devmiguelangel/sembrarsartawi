<?php

namespace Sibas\Entities\Au;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\RetailerProductCategory;

class Detail extends Model
{

    protected $table = 'op_au_details';

    public $incrementing = false;

    protected $casts = [
        'mileage' => 'boolean',
    ];

    protected $appends = [
        'mileage_text',
    ];

    protected $fillable = [
        'id',
        'op_au_header_id',
        'ad_vehicle_type_id',
        'ad_vehicle_make_id',
        'ad_vehicle_model_id',
        'ad_retailer_product_category_id',
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


    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'ad_vehicle_type_id', 'id');
    }


    public function vehicleMake()
    {
        return $this->belongsTo(VehicleMake::class, 'ad_vehicle_make_id', 'id');
    }


    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class, 'ad_vehicle_model_id', 'id');
    }


    public function category()
    {
        return $this->belongsTo(RetailerProductCategory::class, 'ad_retailer_product_category_id', 'id');
    }


    public function setLicensePlateAttribute($value)
    {
        $this->attributes['license_plate'] = strtoupper($value);
    }


    public function getMileageTextAttribute()
    {
        return $this->mileage ? 'SI' : 'NO';
    }

}
