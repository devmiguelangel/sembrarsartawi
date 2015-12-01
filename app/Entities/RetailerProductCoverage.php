<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class RetailerProductCoverage extends Model
{
    protected $table = 'ad_retailer_product_coverages';

    public function coverage(){
        return $this->belongsTo('Sibas\Entities\De\Coverage', 'ad_coverage_id', 'id');
    }
}
