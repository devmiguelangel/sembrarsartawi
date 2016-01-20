<?php

namespace Sibas\Entities\Mc;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'op_mc_answers';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'medical_certificate_number',
        'ad_user_id',
        'mc_certificate_id',
        'center_attention',
        'contact_person',
        'response',
    ];

}
