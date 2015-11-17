<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class CompanyProduct extends Model
{
    protected $table = 'ad_company_products';

    public function company()
    {
        return $this->belongsTo('Sibas\Entities\Company', 'ad_company_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('Sibas\Entities\Product', 'ad_product_id', 'id');
    }

}
