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
}
