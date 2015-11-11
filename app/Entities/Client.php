<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'op_clients';

    public $incrementing = false;
}
