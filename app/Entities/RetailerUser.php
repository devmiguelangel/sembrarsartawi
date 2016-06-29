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


    public function products()
    {
        return $this->belongsToMany(Product::class, 'ad_retailer_user_products', 'ad_retailer_user_id',
            'ad_product_id');
    }

}
