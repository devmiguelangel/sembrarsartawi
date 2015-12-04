<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'op_accounts';

    public $incrementing = false;
}
