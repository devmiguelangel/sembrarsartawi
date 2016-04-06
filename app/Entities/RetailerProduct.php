<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\De\Coverage;

class RetailerProduct extends Model
{

    protected $table = 'ad_retailer_products';

    public $incrementing = false;

    protected $with = [
        'companyProduct',
        'forms',
    ];

    protected $casts = [
        'facultative' => 'boolean',
        'ws'          => 'boolean',
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
        return $this->belongsToMany(Email::class, 'ad_retailer_product_emails', 'ad_retailer_product_id',
            'ad_email_id');
    }


    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'ad_retailer_product_activities', 'ad_retailer_product_id',
            'ad_activity_id');
    }


    public function forms()
    {
        return $this->hasMany(Form::class, 'ad_retailer_product_id', 'id');
    }


    public function content()
    {
        return $this->hasOne(Content::class, 'ad_retailer_product_id', 'id');
    }


    public function coverages()
    {
        return $this->belongsToMany(Coverage::class, 'ad_retailer_product_coverages', 'ad_retailer_product_id',
            'ad_coverage_id')->withPivot('detail');
    }


    public function modalities()
    {
        return $this->hasMany(Modality::class, 'ad_retailer_product_id', 'id');
    }


    public function categories()
    {
        return $this->hasMany(RetailerProductCategory::class, 'ad_retailer_product_id', 'id');
    }


    public function paymentMethods()
    {
        return $this->hasMany(RetailerProductPaymentMethod::class, 'ad_retailer_product_id', 'id');
    }

}
