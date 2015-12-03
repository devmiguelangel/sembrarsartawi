<?php

namespace Sibas\Entities\Vi;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $table = 'op_vi_headers';

    public $incrementing = false;
    
    public function plan() {
        return $this->belongsTo('Sibas\Entities\Plan', 'ad_plan_id', 'id');
    }
}
