<?php

namespace Sibas\Entities\De;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $table = 'op_de_beneficiaries';

    public $incrementing = false;

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = mb_strtoupper($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = mb_strtoupper($value);
    }

    public function setMotherLastNameAttribute($value)
    {
        $this->attributes['mother_last_name'] = mb_strtoupper($value);
    }

    public function setDniAttribute($value)
    {
        $this->attributes['dni'] = mb_strtoupper($value);
    }

    public function setRelationshipAttribute($value)
    {
        $this->attributes['relationship'] = mb_strtoupper($value);
    }
}
