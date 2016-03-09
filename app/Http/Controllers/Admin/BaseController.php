<?php

namespace Sibas\Http\Controllers\Admin;
use Sibas\Http\Controllers\Controller;

abstract class BaseController extends Controller{

    protected function menu_principal(){
        $query = \DB::table('ad_retailer_products as arp')
            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
            ->join('ad_products as ap', 'ap.id' ,'=', 'acp.ad_product_id')
            ->select('ap.code as product', 'arp.id as id_retailer_product', 'arp.ad_retailer_id', 'arp.active', 'ap.name as name_product')
            ->where('acp.active', '=', true)
            ->orderBy('arp.id','asc')
            ->get();
        return $query;
    }

    protected function array_data(){
        $array_data = array();
        $query_products = \DB::table('ad_products')
                            ->orderBy('id','asc')
                            ->get();

        $query_permissions = \DB::table('ad_permissions')
                                ->where('slug','like','A%')
                                ->orderby('id','asc')
                                ->get();

        $array_data['products']=$query_products;
        $array_data['permissions']=$query_permissions;
        return $array_data;
    }
}