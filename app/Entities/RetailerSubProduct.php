<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class RetailerSubProduct extends Model
{
    protected $table = 'ad_retailer_subproducts';

    public function productCompany()
    {
        return $this->belongsTo('Sibas\Entities\RetailerProduct', 'ad_company_product_id', 'ad_company_product_id');
    }
}
