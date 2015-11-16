<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'op_clients';

    public $incrementing = false;

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name . ' ' . $this->mother_last_name;
    }

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

    public function setMarriedNameAttribute($value)
    {
        $this->attributes['married_name'] = mb_strtoupper($value);
    }

    public function setBirthPlaceAttribute($value)
    {
        $this->attributes['birth_place'] = mb_strtoupper($value);
    }

    public function setComplementAttribute($value)
    {
        $this->attributes['complement'] = strtoupper($value);
    }

    public function setLocalityAttribute($value)
    {
        $this->attributes['locality'] = mb_strtoupper($value);
    }

    public function setHomeAddressAttribute($value)
    {
        $this->attributes['home_address'] = mb_strtoupper($value);
    }

    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = mb_strtoupper($value);
    }

    public function setOccupationDescriptionAttribute($value)
    {
        $this->attributes['occupation_description'] = mb_strtoupper($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }


}
