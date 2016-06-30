<?php

namespace Sibas\Entities\Td;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\RetailerProductCategory;

class Detail extends Model
{

    protected $table = 'op_td_details';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'op_td_header_id',
        'matter_insured',
        'matter_description',
        'number',
        'use',
        'city',
        'zone',
        'locality',
        'address',
        'insured_value',
        'rate',
        'premium',
        'approved',
        'rejected',
    ];

    protected $appends = [
        'matter_insured_text',
        'use_text',
        'completed',
    ];


    public function category()
    {
        return $this->belongsTo(RetailerProductCategory::class, 'ad_retailer_product_category_id', 'id');
    }


    public function header()
    {
        return $this->belongsTo(Header::class, 'op_td_header_id', 'id');
    }


    public function facultative()
    {
        return $this->hasOne(Facultative::class, 'op_td_detail_id', 'id');
    }


    public function getMatterInsuredTextAttribute()
    {
        return config('base.property_types.' . $this->matter_insured);
    }


    public function getUseTextAttribute()
    {
        return config('base.property_uses.' . $this->use);
    }


    public function getCompletedAttribute()
    {
        $completed = true;

        return $completed;
    }


    public function setMatterDescriptionAttribute($value)
    {
        $this->attributes['matter_description'] = strtoupper($value);
    }


    public function setZoneAttribute($value)
    {
        $this->attributes['zone'] = strtoupper($value);
    }


    public function setLocalityAttribute($value)
    {
        $this->attributes['locality'] = strtoupper($value);
    }


    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = strtoupper($value);
    }

}
