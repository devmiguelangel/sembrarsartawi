<?php

namespace Sibas\Entities\Vi;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\Plan;

class Header extends Model
{

    protected $table = 'op_vi_headers';

    public $incrementing = false;

    protected $fillable = [
        'ad_certificate_id',
    ];


    public function plan()
    {
        return $this->belongsTo(Plan::class, 'ad_plan_id', 'id');
    }


    public function details()
    {
        return $this->hasMany(Detail::class, 'op_vi_header_id', 'id');
    }
}
