<?php

namespace Sibas\Entities\De;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\State;

class Observation extends Model
{
    protected $table = 'op_de_observations';

    public $incrementing = false;

    protected $casts = [
        'response' => 'boolean',
    ];

    protected $fillable = [
        'id',
        'op_de_facultative_id',
        'ad_user_id',
        'ad_state_id',
        'observation',
        'response',
        'observation_response',
        'date_response',
        'medical_certificate_id',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'ad_state_id', 'id');
    }
}
