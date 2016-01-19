<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class AdRetailerProductActivities extends Model {

    protected $table = 'ad_retailer_product_activities';
    public $incrementing = false;
    protected $casts = [
        'facultative' => 'boolean',
    ];
    
    public function adRetailerProducts() {
        return $this->belongsTo(RetailerProduct::class, 'ad_retailer_product_id', 'id');
    }

    public function adActivities() {
        return $this->belongsTo(Activity::class, 'ad_activity_id', 'id');
        //edw-->return $this->hasMany(Rate::class, 'ad_retailer_product_id', 'id');
    }

}
