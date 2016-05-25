<?php

namespace Sibas\Entities\Td;

use Illuminate\Database\Eloquent\Model;

class Cancellation extends Model
{

    protected $table = 'op_td_cancellations';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'ad_user_id',
        'reason'
    ];

}
