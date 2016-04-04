<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Entities\RetailerProduct;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class IncrementAdminController extends BaseController
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
            $query = \DB::table('ad_retailer_product_categories')
                ->where('ad_retailer_product_id',$id_retailer_product)
                ->get();

            return view('admin.au.increment.list', compact('nav','action', 'id_retailer_product', 'main_menu', 'array_data', 'query'));
        }elseif($action=='new'){
            $vec=array();
            $query=array();
            $retailer_product_query = RetailerProduct::with('retailer','companyProduct.product')->where('id',$id_retailer_product)->first();
            $category = \DB::table('ad_retailer_product_categories')
                            ->where('ad_retailer_product_id',$id_retailer_product)
                            ->get();
            foreach($category as $datos){
                $vec[]=$datos->category;
            }
            foreach(config('base.vehicle_category') as $key=>$data){
                if(in_array($key, $vec)) {

                }else{
                   $query[] = $key.'|'.$data;
                }
            }

           //dd($id_retailer_product);
            return view('admin.au.increment.new', compact('nav', 'action', 'id_retailer_product', 'main_menu', 'array_data', 'retailer_product_query', 'category', 'query'));
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
        try{

            $query_insert = \DB::table('ad_retailer_product_categories')->insert(
                [
                    'ad_retailer_product_id' => $request->get('id_retailer_products'),
                    'category' => $request->get('category'),
                    'active' => true,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ]
            );

            return redirect()->route('admin.au.increment.list', ['nav' => 'au_increment', 'action' => 'list', 'id_retailer_product'=>$request->get('id_retailer_products')])->with(array('ok' => 'Se registro correctamente los datos del formulario'));
        }catch(QueryException $e) {
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

    /**
     * ajax.
     *
     *
     * procesos ajax
     */
    public function ajax_active_inactive($id_increment, $text, $id_retailer_product){
        if($text=='inactive'){
            try {
                $query_update = \DB::table('ad_retailer_product_categories')
                    ->where('id', $id_increment)
                    ->where('ad_retailer_product_id', $id_retailer_product)
                    ->update(['active' => false]);
                return response()->json(['response'=>'ok', 'text' => 'Se desactivo correctamente el registro']);
            }catch(QueryException $e) {
                return response()->json(['response'=>'error', 'text' => $e->getMessage()]);
            }
        }elseif($text=='active'){
            try {
                $query_update = \DB::table('ad_retailer_product_categories')
                    ->where('id', $id_increment)
                    ->where('ad_retailer_product_id', $id_retailer_product)
                    ->update(['active' => true]);
                return response()->json(['response'=>'ok', 'text' => 'Se activo correctamente el registro']);
            }catch(QueryException $e) {
                return response()->json(['response'=>'error', 'text' => $e->getMessage()]);
            }
        }
    }
}
