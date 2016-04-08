<?php

namespace Sibas\Entities\Au;

use Illuminate\Database\Eloquent\Model;

class Facultative extends Model
{

    protected $table = 'op_au_facultatives';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'ad_user_id',
        'reason',
        'state',
        'approved',
        'surcharge',
        'percentage',
        'current_rate',
        'final_rate',
        'observation',
        'read',
    ];

}
