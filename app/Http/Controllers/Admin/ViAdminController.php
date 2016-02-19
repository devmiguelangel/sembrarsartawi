<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Entities\ProductParameter;
use Sibas\Entities\RetailerProduct;
use Sibas\Http\Requests;


class ViAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        if($action=='list'){
            $query = RetailerProduct::join('ad_company_products', 'ad_company_products.id', '=', 'ad_retailer_products.ad_company_product_id')
                                    ->join('ad_products', 'ad_products.id', '=', 'ad_company_products.ad_product_id')
                                    ->select('ad_retailer_products.id as id_retailer_product', 'ad_retailer_products.type', 'ad_retailer_products.billing', 'ad_retailer_products.provisional_certificate', 'ad_retailer_products.modality', 'ad_retailer_products.facultative', 'ad_retailer_products.ws', 'ad_retailer_products.active', 'ad_products.name as producto')
                                    ->where('ad_retailer_products.id', '=', $id_retailer_product)
                                    ->get();
            //dd($query);
            return view('admin.vi.parameters.list', compact('nav', 'action', 'id_retailer_product', 'query', 'main_menu'));
        }elseif($action=='list_parameter_additional'){
            $query = \DB::table('ad_product_parameters')
                ->where('ad_retailer_product_id', '=', $id_retailer_product)
                ->get();
            //dd($query);
            return view('admin.vi.parameters.list-parameter-additional', compact('nav', 'action', 'query', 'id_retailer_product', 'main_menu'));
        }elseif($action=='new_parameter_additional'){
            return view('admin.vi.parameters.new-parameter-additional', compact('nav', 'action', 'id_retailer_product', 'main_menu'));
        }elseif($action=='new'){
            return view('admin.vi.parameters.new', compact('nav','action', 'id_retailer_product', 'main_menu'));
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
            $name = $parameter[$request->input('prod_param')];
            $id_retailer_product = $request->input('id_retailer_product');
            $query_int = new ProductParameter();
            $query_int->ad_retailer_product_id = $id_retailer_product;
            $query_int->name = $name;
            $query_int->slug = $request->input('prod_param');
            $query_int->age_min = $request->input('edad_min');
            $query_int->age_max = $request->input('edad_max');
            $query_int->amount_min = $request->input('monto_min');
            $query_int->amount_max = $request->input('monto_max');
            $query_int->expiration = $request->input('caduc');
            $query_int->detail = $request->input('num_titu');
            if ($query_int->save()) {
                return redirect()->route('admin.vi.parameters.list-parameter-additional', ['nav' => 'vi', 'action' => 'list_parameter_additional', 'id_retailer_product' => $id_retailer_product])->with(array('ok'=>'Se agrego correctamente los datos del formulario'));
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
        $query = \DB::table('ad_retailer_products')
                     ->join('ad_company_products', 'ad_company_products.id', '=', 'ad_retailer_products.ad_company_product_id')
                     ->join('ad_products', 'ad_products.id', '=', 'ad_company_products.ad_product_id')
                     ->select('ad_retailer_products.type', 'ad_retailer_products.billing', 'ad_retailer_products.provisional_certificate', 'ad_retailer_products.modality', 'ad_retailer_products.facultative', 'ad_retailer_products.ws', 'ad_products.name as producto', 'ad_retailer_products.ad_retailer_id')
                     ->where('ad_retailer_products.id', '=', $id_retailer_product)
                     ->first();
        //dd($query);
        return view('admin.vi.parameters.edit', compact('nav', 'action', 'id_retailer_product', 'query', 'main_menu'));
    }

    public function edit_parameter_additional($nav, $action, $id_product_parameters, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        $query = \DB::table('ad_product_parameters')
                        ->where('id', $id_product_parameters)
                        ->where('ad_retailer_product_id', $id_retailer_product)
                        ->first();
        //dd($query);
        return view('admin.vi.parameters.edit-parameter-additional', compact('nav', 'action', 'id_product_parameters', 'id_retailer_product', 'query', 'main_menu'));
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
        try {
            $retailer_update = RetailerProduct::where('id', $request->input('id_retailer_product'))->first();
            $retailer_update->billing = $request->input('fact');
            $retailer_update->provisional_certificate = $request->input('cert');
            $retailer_update->modality = $request->input('moda');
            $retailer_update->facultative = $request->input('facu');
            $retailer_update->ws = $request->input('webs');
            if ($retailer_update->save()) {
                return redirect()->route('admin.vi.parameters.list', ['nav' => 'vi', 'action' => 'list', 'id_retailer_product' => $request->input('id_retailer_product')])->with(array('ok'=>'Se actualizo correctamente los datos del formulario'));
            }
        }catch (QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }
    }

    public function update_parameter_additional(Request $request)
    {
        $parameter = config('base.product_parameters');
        $name = $parameter[$request->input('prod_param')];

        $query_update = ProductParameter::where('id', $request->input('id_product_parameters'))->where('ad_retailer_product_id', $request->input('id_retailer_product'))->first();
        //dd($query_update);
        if($query_update instanceof ProductParameter){
            $query_update->name=$name;
            $query_update->slug=$request->input('prod_param');
            $query_update->age_min=$request->input('edad_min');
            $query_update->age_max=$request->input('edad_max');
            $query_update->amount_min=$request->input('monto_min');
            $query_update->amount_max=$request->input('monto_max');
            $query_update->expiration=$request->input('caduc');
            $query_update->detail=$request->input('num_titu');
            if($query_update->save()){
                return redirect()->route('admin.vi.parameters.list-parameter-additional', ['nav'=>'vi', 'action'=>'list_parameter_additional', 'id_retailer_product'=>$request->input('id_retailer_product')])->with(array('ok'=>'Se edito correctamente los datos del formulario'));
            }
        }else{
            return redirect()->back()->with(array('error'=>'error de consulta'));
        }

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
