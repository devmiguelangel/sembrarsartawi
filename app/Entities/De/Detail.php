<?php

namespace Sibas\Entities\De;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'op_de_details';

    public $incrementing = false;

    public function client()
    {
        return $this->belongsTo('Sibas\Entities\Client', 'op_client_id', 'id');
    }

    public function response()
    {
        return $this->hasOne('Sibas\Entities\De\Response', 'op_de_detail_id', 'id');
    }

    public function beneficiary()
    {
        return $this->hasOne('Sibas\Entities\De\Beneficiary', 'op_de_detail_id', 'id');
    }

    public function facultative()
    {
        return $this->hasOne('Sibas\Entities\De\Facultative', 'op_de_detail_id', 'id');
    }

    public function getCompletedAttribute()
    {
        return (! is_null($this->beneficiary) ? true : false);
    }

}
