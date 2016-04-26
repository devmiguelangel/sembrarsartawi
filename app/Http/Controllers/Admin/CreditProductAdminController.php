<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Sibas\Entities\RetailerProduct;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class CreditProductAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='list'){
            $retailer_product_query = RetailerProduct::with('retailer','companyProduct.product')->where('id',$id_retailer_product)->first();
            $query=\DB::table('ad_credit_products')
                ->get();
            return view('admin.de.creditproduct.list', compact('nav', 'action', 'id_retailer_product', 'main_menu', 'array_data', 'query', 'retailer_product_query'));
        }elseif($action=='new'){
            $vec=array();
            $query=array();
            $retailer_product_query = RetailerProduct::with('retailer','companyProduct.product')->where('id',$id_retailer_product)->first();
            $credit_product = \DB::table('ad_credit_products')
                ->where('ad_retailer_product_id',$id_retailer_product)
                ->get();
            foreach($credit_product as $datos){
                $vec[]=$datos->slug;
            }
            foreach(config('base.credit_products') as $key=>$data){
                if(in_array($key, $vec)) {

                }else{
                    $query[] = $key.'|'.$data;
                }
            }
            return view('admin.de.creditproduct.new', compact('nav', 'action', 'id_retailer_product', 'main_menu', 'array_data', 'retailer_product_query', 'query'));
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
        $arr = explode('|',$request->get('credit_product'));
        try {
            $query_insert = \DB::table('ad_credit_products')->insert(
                [
                    'ad_retailer_product_id' => $request->get('id_retailer_product'),
                    'name' => $arr[1],
                    'slug' => $arr[0],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]
            );

            return redirect()->route('admin.de.creditproduct.list', ['nav' => 'credit_product', 'action' => 'list', 'id_retailer_product' => $request->get('id_retailer_product')])->with(array('ok'=>'Se registro correctamente los datos del formulario'));

        }catch(QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
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
}
