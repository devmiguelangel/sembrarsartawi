<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    protected $table = 'ad_retailers';

    public function users()
    {
        return $this->belongsToMany('Sibas\Entities\User', 'ad_retailer_users', 'ad_user_id', 'ad_retailer_id');
    }
}
