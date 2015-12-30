<?php

namespace Sibas\Entities\Vi;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\Plan;

class Header extends Model
{
    protected $table = 'op_vi_headers';

    public $incrementing = false;
    
    public function plan() {
        return $this->belongsTo(Plan::class, 'ad_plan_id', 'id');
    }
}
