<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'ad_activities';

    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        return $this->category . ' - ' . $this->occupation;
    }

}
