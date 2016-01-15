<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Sibas\Entities\Retailer;
use Sibas\Http\Requests;


class CompanyProductToRetailerAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_company)
    {
        $main_menu = $this->menu_principal();
        if($action=='list'){
            $query = \DB::table('ad_retailer_products as arp')
                ->join('ad_retailers as ar', 'ar.id', '=', 'arp.ad_retailer_id')
                ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                ->select('arp.id as id_retailer_products', 'ar.name as retailer', 'ap.name as product', 'arp.type', 'arp.active')
                ->get();
            $parameter = config('base.retailer_product_types');
            //dd($parameter);
            return view('admin.addtoretailer.list', compact('nav', 'action', 'id_company', 'main_menu', 'query', 'parameter'));
        }elseif($action=='new'){
            $query_ret = Retailer::where('active', true)->get();

            $query_pr_co = \DB::table('ad_company_products as acp')
                                ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                                ->select('acp.id as id_company_products', 'ap.name as product')
                                ->where('acp.active', true)
                                ->where('acp.ad_company_id', $id_company)
                                ->get();
            return view('admin.addtoretailer.new', compact('nav', 'action', 'id_company', 'main_menu', 'query_ret', 'query_pr_co'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query_insert = \DB::table('ad_retailer_products')->insert(
            ['id'=>date('U'), 'ad_retailer_id'=>$request->input('id_retailer'), 'ad_company_product_id'=>$request->input('id_company_products'), 'type'=>$request->input('tipo_prod'), 'active'=>false, 'created_at'=>date("Y-m-d H:i:s"), 'updated_at'=>date("Y-m-d H:i:s")]
        );
        if($query_insert){
            return redirect()->route('admin.addtoretailer.list', ['nav'=>'addtoretailer', 'action'=>'list', 'id_company'=>$request->input('id_company')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * ajax
     *
     * procesos ajax
     */
    public function ajax_quest($id_company_product, $id_retailer)
    {
        $query = \DB::table('ad_retailer_products')
                    ->where('ad_retailer_id', $id_retailer)
                    ->where('ad_company_product_id', $id_company_product)
                    ->first();
        //dd(count($query));
        if(count($query)>0){
            return 1;
        }else{
            return 0;
        }
    }

    public function ajax_active_inactive($id_retailer_products, $text){
        if($text=='inactive'){
            $query_update = \DB::table('ad_retailer_products')
                ->where('id', $id_retailer_products)
                ->update(['active' => false]);
            //dd($query_update);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }elseif($text=='active'){
            $query_update = \DB::table('ad_retailer_products')
                ->where('id', $id_retailer_products)
                ->update(['active' => true]);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }
    }

}
