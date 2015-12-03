<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class RetailerProduct extends Model
{
    protected $table = 'ad_retailer_products';

    public $incrementing = false;

    protected $casts = [
        'facultative' => 'boolean',
    ];

    public function productQuestions()
    {
        return $this->hasMany('Sibas\Entities\RetailerProductQuestion', 'ad_retailer_product_id', 'id');
    }

    public function rates()
    {
        return $this->hasMany('Sibas\Entities\Rate', 'ad_retailer_product_id', 'id');
    }

    public function companyProduct()
    {
        return $this->belongsTo('Sibas\Entities\CompanyProduct', 'ad_company_product_id', 'id');
    }

    public function subProducts()
    {
        return $this->hasMany('Sibas\Entities\RetailerSubProduct', 'ad_retailer_product_id', 'id');
    }

    public function plans()
    {
        return $this->hasMany('Sibas\Entities\Plan', 'ad_retailer_product_id', 'id');
    }

    public function parameters()
    {
        return $this->hasMany('Sibas\Entities\ProductParameter', 'ad_retailer_product_id', 'id');
    }

    public function retailer()
    {
        return $this->belongsTo('Sibas\Entities\Retailer', 'ad_retailer_id', 'id');
    }
}
