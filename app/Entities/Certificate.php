<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{

    protected $table = 'ad_certificates';


    public function creditProduct()
    {
        return $this->belongsTo(CreditProduct::class, 'ad_credit_product_id', 'id');
    }
}
