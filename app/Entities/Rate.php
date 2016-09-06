<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\Au\Increment;

class Rate extends Model
{

    protected $table = 'ad_rates';


    public function increments()
    {
        return $this->hasMany(Increment::class, 'ad_rate_id', 'id');
    }


    public function creditProduct()
    {
        return $this->belongsTo(CreditProduct::class, 'ad_credit_product_id', 'id');
    }

}
