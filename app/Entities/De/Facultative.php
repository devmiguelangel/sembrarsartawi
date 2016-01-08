<?php

namespace Sibas\Entities\De;

use Illuminate\Database\Eloquent\Model;

class Facultative extends Model
{
    protected $table = 'op_de_facultatives';

    public $incrementing = false;

    protected $fillable = ['id', 'reason', 'state', ];

    public function detail()
    {
        return $this->belongsTo(Detail::class, 'op_de_detail_id', 'id');
    }

}
