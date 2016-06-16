<?php

namespace Sibas\Entities;

use Illuminate\Database\Eloquent\Model;

class RetailerUser extends Model
{

    protected $table = 'ad_retailer_users';


    public function retailer()
    {
        return $this->belongsTo(Retailer::class, 'ad_retailer_id', 'id');
    }


    public function company()
    {
        return $this->belongsTo(Company::class, 'ad_company_id', 'id');
    }

}
