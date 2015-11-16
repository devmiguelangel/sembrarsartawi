<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class RetailerProduct extends Model
{
    protected $table = 'ad_retailer_products';

    public $incrementing = false;

    public function productQuestions()
    {
        return $this->hasMany('Sibas\Entities\RetailerProductQuestion', 'ad_retailer_product_id', 'id');
    }

}
