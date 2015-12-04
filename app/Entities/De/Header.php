<?php

namespace Sibas\Entities\De;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $table = 'op_de_headers';

    public $incrementing = false;

    protected $casts = [
        'facultative' => 'boolean',
    ];

    public function coverage()
    {
        return $this->hasOne('Sibas\Entities\De\Coverage', 'id', 'ad_coverage_id');
    }

    public function details()
    {
        return $this->hasMany('Sibas\Entities\De\Detail', 'op_de_header_id', 'id');
    }

    public function getCompletedAttribute()
    {
        $completed = true;

        foreach ($this->details as $detail) {
            if (!$detail->completed) {
                $completed = false;

                break;
            }
        }

        return $completed;
    }

}
