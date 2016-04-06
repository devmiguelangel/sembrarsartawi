<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Entities\RetailerProduct;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class PaymentAdminController extends BaseController
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
        $retailer_product_query = RetailerProduct::with('retailer','companyProduct.product')->where('id',$id_retailer_product)->first();
        if($action=='list'){
            $query = \DB::table('ad_payment_methods as apm')
                        ->join('ad_retailer_products as arp', 'arp.id', '=', 'apm.ad_retailer_product_id')
                        ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                        ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                        ->select('apm.id as id_payment_method', 'ap.name as product', 'apm.payment_method', 'apm.active')
                        ->where('apm.ad_retailer_product_id',$id_retailer_product)
                        ->get();
            //dd($retailer_product_query);
            return view('admin.payment.list', compact('nav', 'action', 'id_retailer_product', 'main_menu', 'array_data', 'query', 'retailer_product_query'));
        }elseif($action=='new'){
            $vec=array();
            $query=array();
            $retailer_product_query = RetailerProduct::with('retailer','companyProduct.product')->where('id',$id_retailer_product)->first();
            $payment = \DB::table('ad_payment_methods')
                ->where('ad_retailer_product_id',$id_retailer_product)
                ->get();
            foreach($payment as $datos){
                $vec[]=$datos->payment_method;
            }
            foreach(config('base.payment_methods') as $key=>$data){
                if(in_array($key, $vec)) {

                }else{
                    $query[] = $key.'|'.$data;
                }
            }
            //dd($query);
            return view('admin.payment.new', compact('nav', 'action', 'id_retailer_product', 'main_menu', 'array_data', 'retailer_product_query', 'query'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * LIST PRODUCT RETAILER
     */
    public function index_product_retailer($nav, $action)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $query = \DB::table('ad_retailer_products as arp')
            ->join('ad_retailers as ar', 'ar.id', '=', 'arp.ad_retailer_id')
            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
            ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
            ->select('arp.id as id_retailer_product', 'ar.name as retailer', 'ap.name as product', 'arp.type', 'arp.active', 'ap.code')
            ->orderBy('arp.type')
            ->get();
        $parameter = config('base.retailer_product_types');
        return view('admin.payment.list-product-retailer', compact('nav', 'action', 'main_menu', 'array_data', 'query', 'parameter'));
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
            $query_insert = \DB::table('ad_payment_methods')->insert(
                [
                    'ad_retailer_product_id' => $request->get('id_retailer_product'),
                    'payment_method' => $request->get('payment_method'),
                    'active' => true,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ]
            );

            return redirect()->route('admin.payment.list', ['nav' => 'payment', 'action' => 'list', 'id_retailer_product'=>$request->get('id_retailer_product')])->with(array('ok' => 'Se registro correctamente los datos del formulario'));
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
     * AJAX
     *
     * activar inactivar
     */
    public function ajax_active_inactive($id_payment_method, $text, $id_retailer_product){
        //dd($id_company);
        if($text=='inactive'){
            try {
                $query_update = \DB::table('ad_payment_methods')
                    ->where('id', $id_payment_method)
                    ->where('ad_retailer_product_id', $id_retailer_product)
                    ->update(['active' => false]);
                //dd($query_update);
                return response()->json(['response' => 'ok', 'text' => 'Se desactivo el registro correctamente']);
            }catch(QueryException $e) {
                return response()->json(['response' => 'error', 'text' => $e->getMessage()]);
            }
        }elseif($text=='active'){
            try {
                $query_update = \DB::table('ad_payment_methods')
                    ->where('id', $id_payment_method)
                    ->where('ad_retailer_product_id', $id_retailer_product)
                    ->update(['active' => true]);
                return response()->json(['response' => 'ok', 'text' => 'Se activo el registro correctamente']);
            }catch(QueryException $e) {
                return response()->json(['response' => 'error', 'text' => $e->getMessage()]);
            }
        }
    }

    /**
     * AJAX
     *
     * eliminar registro
     */
    public function ajax_delete($id_payment_method,$id_retailer_product)
    {
        try{
            $query_del = \DB::table('ad_payment_methods')
                ->where('id', $id_payment_method)
                ->where('ad_retailer_product_id', $id_retailer_product)
                ->delete();
            //return '1|Se elimino correctamente el registro';
            return response()->json(['response'=>'ok', 'detail'=>'Se elimino correctamente el registro']);
        }catch (QueryException $e){
            //return '0|'.$e->getMessage();
            return response()->json(['response'=>'error', 'detail'=>$e->getMessage()]);
        }
    }
}
