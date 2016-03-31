<?php

namespace Sibas\Entities\Au;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{

    protected $table = 'op_au_headers';

    public $incrementing = false;


    public function details()
    {
        return $this->hasMany(Detail::class, 'op_au_header_id', 'id');
    }

}
