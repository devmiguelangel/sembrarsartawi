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
        return $this->hasMany(RetailerProductQuestion::class, 'ad_retailer_product_id', 'id');
    }

    public function rates()
    {
        return $this->hasMany(Rate::class, 'ad_retailer_product_id', 'id');
    }

    public function companyProduct()
    {
        return $this->belongsTo(CompanyProduct::class, 'ad_company_product_id', 'id');
    }

    public function subProducts()
    {
        return $this->hasMany(RetailerSubProduct::class, 'ad_retailer_product_id', 'id');
    }

    public function plans()
    {
        return $this->hasMany(Plan::class, 'ad_retailer_product_id', 'id');
    }

    public function parameters()
    {
        return $this->hasMany(ProductParameter::class, 'ad_retailer_product_id', 'id');
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class, 'ad_retailer_id', 'id');
    }

    public function emails()
    {
        return $this->belongsToMany(Email::class, 'ad_retailer_product_emails', 'ad_retailer_product_id', 'ad_email_id');
    }
}
