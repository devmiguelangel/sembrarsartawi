<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    protected $table = 'ad_retailers';

    public function users()
    {
        return $this->belongsToMany(User::class, 'ad_retailer_users', 'ad_retailer_id', 'ad_user_id');
    }

    public function retailerProducts()
    {
        return $this->hasMany(RetailerProduct::class, 'ad_retailer_id', 'id');
    }

    public function exchangeRate()
    {
        return $this->hasOne(ExchangeRate::class, 'ad_retailer_id', 'id');
    }
}
