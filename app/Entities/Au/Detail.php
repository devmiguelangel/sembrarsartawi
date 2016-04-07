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
        'completed',
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


    public function header()
    {
        return $this->belongsTo(Header::class, 'op_au_header_id', 'id');
    }


    public function facultative()
    {
        return $this->hasOne(Facultative::class, 'op_au_detail_id', 'id');
    }


    public function setLicensePlateAttribute($value)
    {
        $this->attributes['license_plate'] = strtoupper($value);
    }


    public function setColorAttribute($value)
    {
        $this->attributes['color'] = strtoupper($value);
    }


    public function setEngineAttribute($value)
    {
        $this->attributes['engine'] = strtoupper($value);
    }


    public function setChassisAttribute($value)
    {
        $this->attributes['chassis'] = strtoupper($value);
    }


    public function getMileageTextAttribute()
    {
        return $this->mileage ? 'SI' : 'NO';
    }


    public function getCompletedAttribute()
    {
        return ( empty( $this->color ) || empty( $this->engine ) || empty( $this->chassis ) ) ? false : true;
    }

}
