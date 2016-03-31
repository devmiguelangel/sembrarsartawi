<?php

namespace Sibas\Entities\Au;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\RetailerProductCategory;

class VehicleType extends Model
{

    protected $table = 'ad_vehicle_types';

    protected $hidden = [
        'ad_retailer_product_category_id',
        'created_at',
        'updated_at',
    ];


    public function category()
    {
        return $this->belongsTo(RetailerProductCategory::class, 'ad_retailer_product_category_id', 'id');
    }

}
