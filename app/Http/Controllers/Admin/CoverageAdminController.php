<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Http\Requests;


class CoverageAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='list'){
            $query = \DB::table('ad_retailer_product_coverages as arpc')
                        ->join('ad_coverages as ac', 'ac.id', '=', 'arpc.ad_coverage_id')
                        ->join('ad_retailer_products as arp', 'arp.id', '=', 'arpc.ad_retailer_product_id')
                        ->join('ad_retailers as ar', 'ar.id', '=', 'arp.ad_retailer_id')
                        ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                        ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                        ->select('arpc.id as id_retailer_product_coverage', 'ac.name as coverage', 'ap.name as product', 'arpc.detail as num_holder', 'ar.name as retailer', 'arpc.active')
                        ->where('ar.active', true)
                        ->get();
            return view('admin.cobertura.list', compact('nav', 'action', 'main_menu', 'query', 'array_data'));
        }elseif($action=='new'){
            $query = \DB::table('ad_retailers')
                        ->where('active',true)
                        ->get();
            $query_coverage = \DB::table('ad_coverages')
                                ->get();
            return view('admin.cobertura.new', compact('nav', 'action', 'query', 'main_menu', 'query_coverage', 'array_data'));
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
            $query_permissions = \DB::table('ad_retailer_product_coverages')->insert(
                [
                    'ad_retailer_product_id' => $request->get('id_product'),
                    'ad_coverage_id' => $request->get('id_cobertura'),
                    'detail' => $request->get('num_titulares'),
                    'active' => true,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ]
            );
            return redirect()->route('admin.cobertura.list', ['nav' => 'coverage', 'action' => 'list'])->with(array('ok' => 'Se registro correctamente los datos del formulario'));
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
    public function edit($nav, $action, $id_retailer_product_coverage)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $query = \DB::table('ad_retailer_product_coverages as arpc')
            ->join('ad_coverages as ac', 'ac.id', '=', 'arpc.ad_coverage_id')
            ->join('ad_retailer_products as arp', 'arp.id', '=', 'arpc.ad_retailer_product_id')
            ->join('ad_retailers as ar', 'ar.id', '=', 'arp.ad_retailer_id')
            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
            ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
            ->select('arpc.id as id_retailer_product_coverage', 'ac.name as coverage', 'ap.name as product', 'arpc.detail as num_holder', 'ar.name as retailer', 'arpc.active')
            ->where('ar.active', true)
            ->where('arpc.id', '=', $id_retailer_product_coverage)
            ->first();
        return view('admin.cobertura.edit', compact('nav', 'action', 'main_menu', 'query', 'id_retailer_product_coverage', 'array_data'));
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
            $query_update = \DB::table('ad_retailer_product_coverages')
                ->where('id', $request->get('id_retailer_product_coverage'))
                ->update(
                    [
                        'detail' => $request->get('num_titulares'),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]
                );
            return redirect()->route('admin.cobertura.list', ['nav' => 'coverage', 'action' => 'list'])->with(array('ok' => 'Se edito correctamente los datos del formulario'));
        }catch (QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
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

    //FUNCIONES AJAX
    public function ajax_product_retailer($id_retailer)
    {
        $product_retailer=\DB::table('ad_retailer_products as arp')
            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
            ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
            ->select('arp.id as id_retailer_product', 'ap.name as product')
            ->where('arp.ad_retailer_id', '=', $id_retailer)
            ->where('ap.type', '=', 'PH')
            ->where('ap.code','<>','vi')
            ->get();
        return response()->json($product_retailer);
    }

    public function ajax_active_inactive($id_retailer_product_coverage, $text){
        //dd($id_company);
        if($text=='inactive'){
            $query_update = \DB::table('ad_retailer_product_coverages')
                ->where('id', $id_retailer_product_coverage)
                ->update(['active' => false]);
            //dd($query_update);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }elseif($text=='active'){
            $query_update = \DB::table('ad_retailer_product_coverages')
                ->where('id', $id_retailer_product_coverage)
                ->update(['active' => true]);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }
    }
}
