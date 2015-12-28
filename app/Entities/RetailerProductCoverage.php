<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\De\Coverage;

class RetailerProductCoverage extends Model
{
    protected $table = 'ad_retailer_product_coverages';

    public function coverage(){
        return $this->belongsTo(Coverage::class, 'ad_coverage_id', 'id');
    }
}
