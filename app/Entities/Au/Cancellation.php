<?php

namespace Sibas\Entities\Au;

use Illuminate\Database\Eloquent\Model;

class Cancellation extends Model
{

    protected $table = 'op_au_cancellations';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'ad_user_id',
        'reason'
    ];

}
