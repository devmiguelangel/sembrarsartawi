<?php

namespace Sibas\Entities\De;

use Illuminate\Database\Eloquent\Model;

class Cancellation extends Model
{
    protected $table = 'op_de_cancellations';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'op_de_header_id',
        'ad_user_id',
        'reason',
    ];

    public function setReasonAttribute($value)
    {
        $this->attributes['reason'] = mb_strtoupper($value);
    }

}
