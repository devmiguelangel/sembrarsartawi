<?php

namespace Sibas\Entities\De;

use Illuminate\Database\Eloquent\Model;
use Sibas\Entities\Client;

class Detail extends Model
{
    protected $table = 'op_de_details';

    public $incrementing = false;

    public function client()
    {
        return $this->belongsTo(Client::class, 'op_client_id', 'id');
    }

    public function response()
    {
        return $this->hasOne(Response::class, 'op_de_detail_id', 'id');
    }

    public function beneficiary()
    {
        return $this->hasOne(Beneficiary::class, 'op_de_detail_id', 'id');
    }

    public function facultative()
    {
        return $this->hasOne(Facultative::class, 'op_de_detail_id', 'id');
    }

    public function getCompletedAttribute()
    {
        return (! is_null($this->beneficiary) ? true : false);
    }

}
