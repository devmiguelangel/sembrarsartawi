<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Entities\ProductParameter;
use Sibas\Entities\RetailerProduct;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class MrAdminController extends BaseController
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
        $query = RetailerProduct::join('ad_company_products', 'ad_company_products.id', '=', 'ad_retailer_products.ad_company_product_id')
            ->join('ad_products', 'ad_products.id', '=', 'ad_company_products.ad_product_id')
            ->select('ad_retailer_products.id as id_retailer_product', 'ad_retailer_products.type', 'ad_retailer_products.billing', 'ad_retailer_products.provisional_certificate', 'ad_retailer_products.modality', 'ad_retailer_products.facultative', 'ad_retailer_products.ws', 'ad_retailer_products.active', 'ad_products.name as producto')
            ->where('ad_retailer_products.id', '=', $id_retailer_product)
            ->first();
        //$retailer_product_query = RetailerProduct::with('retailer','companyProduct.product')->where('id',$id_retailer_product)->first();
        //dd($retailer_product_query);
        return view('admin.mr.parameters.list-parameter', compact('nav', 'action', 'id_retailer_product', 'main_menu', 'array_data', 'query'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_parameter($nav, $action, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $retailer_product_query = RetailerProduct::with('retailer','companyProduct.product')->where('id',$id_retailer_product)->first();
        if($action=='list_parameter_additional'){
            $query = \DB::table('ad_product_parameters')
                ->where('ad_retailer_product_id', '=', $id_retailer_product)
                ->get();
            //dd($retailer_product_query);
            return view('admin.mr.parameters.list-parameter-additional', compact('nav', 'action', 'id_retailer_product', 'main_menu','array_data', 'query', 'retailer_product_query'));
        }elseif($action=='new_parameter_additional'){
            //dd($retailer_product_query);
            return view('admin.mr.parameters.new-parameter-additional', compact('nav', 'action', 'id_retailer_product', 'main_menu', 'array_data', 'retailer_product_query'));
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
        try {
            $parameter = config('base.product_parameters');
            $name = $parameter[$request->get('prod_param')];
            $id_retailer_product = $request->get('id_retailer_product');
            $query_int = new ProductParameter();
            $query_int->ad_retailer_product_id = $id_retailer_product;
            $query_int->name = $name;
            $query_int->slug = $request->get('prod_param');
            $query_int->age_min = $request->get('edad_min');
            $query_int->age_max = $request->get('edad_max');
            $query_int->amount_min = $request->get('monto_min');
            $query_int->amount_max = $request->get('monto_max');
            $query_int->expiration = $request->get('caduc');
            $query_int->detail = $request->get('cantidad');
            if ($query_int->save()) {
                return redirect()->route('admin.mr.parameters.list-parameter-additional', ['nav' => 'mr_parameter', 'action' => 'list_parameter_additional', 'id_retailer_product' => $id_retailer_product])->with(array('ok'=>'Se registro correctamente los datos del formulario'));
            }
        }catch (QueryException $e){
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
    public function edit($nav, $action, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();

        $query = \DB::table('ad_retailer_products as arp')
            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
            ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
            ->select('arp.type', 'arp.billing', 'arp.provisional_certificate', 'arp.modality', 'arp.facultative', 'arp.ws', 'ap.name as producto', 'arp.ad_retailer_id')
            ->where('arp.id', '=', $id_retailer_product)
            ->first();
        //dd($query);
        return view('admin.mr.parameters.edit-parameter', compact('nav', 'action', 'query', 'id_retailer_product', 'main_menu', 'array_data'));
    }

    public function edit_parameter_additional($nav, $action, $id_product_parameters, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $retailer_product_query = RetailerProduct::with('retailer','companyProduct.product')->where('id',$id_retailer_product)->first();

        if($action=='edit_parameter_additional'){
            //dd($id_retailer_product);
            $query = ProductParameter::where('id',$id_product_parameters)
                ->where('ad_retailer_product_id',$id_retailer_product)
                ->first();
            //dd($query);
            return view('admin.mr.parameters.edit-parameter-additional', compact('nav', 'action', 'id_product_parameters', 'id_retailer_product', 'main_menu', 'array_data', 'query', 'retailer_product_query'));
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $retailer_update = RetailerProduct::find($request->input('id_retailer_product'));
            $retailer_update->billing=$request->input('fact');
            $retailer_update->provisional_certificate=$request->input('cert');
            $retailer_update->modality=$request->input('moda');
            $retailer_update->facultative=$request->input('facu');
            $retailer_update->ws=$request->input('webs');
            if($retailer_update->save()) {
                return redirect()->route('admin.mr.parameters.list-parameter', ['nav' => 'mr_parameter', 'action' => 'list_parameter', 'id_retailer_product'=>$request->input('id_retailer_product')])->with(array('ok'=>'Se edito correctamente los datos del formulario'));
            }
        }catch (QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }
    }

    public function update_parameter_additional(Request $request)
    {
        try {
            $parameter = config('base.product_parameters');
            $name = $parameter[$request->input('prod_param')];
            $query_update = ProductParameter::where('id', $request->input('id_product_parameter'))->where('ad_retailer_product_id', $request->input('id_retailer_product'))->first();
            $query_update->name = $name;
            $query_update->slug = $request->get('prod_param');
            $query_update->age_min = $request->get('edad_min');
            $query_update->age_max = $request->get('edad_max');
            $query_update->amount_min = $request->get('monto_min');
            $query_update->amount_max = $request->get('monto_max');
            $query_update->expiration = $request->get('caduc');
            $query_update->detail = $request->get('cantidad');
            if ($query_update->save()) {
                return redirect()->route('admin.mr.parameters.list-parameter-additional', ['nav' => 'mr_parameter', 'action' => 'list_parameter_additional', 'id_retailer_product' => $request->input('id_retailer_product')])->with(array('ok'=>'Se edito correctamente los datos del formulario'));
            }
        }catch (QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }

        //dd($request->input('id_retailer_product'));
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
