<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class TasasAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action)
    {
        $main_menu = $this->menu_principal();
        if($action=='list'){
            $query = \DB::table('ad_rates as ar')
                ->join('ad_coverages as ac', 'ac.id', '=', 'ar.ad_coverage_id')
                ->join('ad_retailer_products as arp', 'arp.id', '=', 'ar.ad_retailer_product_id')
                ->join('ad_retailers as aret', 'aret.id', '=', 'arp.ad_retailer_id')
                ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                ->select('ar.id as id_rates', 'ar.rate_company', 'ar.rate_bank', 'ar.rate_final', 'ap.name as product', 'ac.name as coverage', 'aret.name as retailer')
                ->get();
            return view('admin.tasas.list', compact('nav', 'action', 'query', 'main_menu'));
        }elseif($action=='new'){
            $retailer = \DB::table('ad_retailers')
                            ->get();
            return view('admin.tasas.new', compact('nav', 'action', 'main_menu', 'retailer'));
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
            $query_insert = \DB::table('ad_rates')->insert(
                [
                    'rate_company' => $request->get('rate_company'),
                    'rate_bank' => $request->get('rate_bank'),
                    'rate_final' => $request->get('rate_final'),
                    'ad_retailer_product_id' => $request->get('id_producto_retailer'),
                    'ad_credit_product_id' => null,
                    'ad_coverage_id' => $request->get('id_coverage'),
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ]
            );
            return redirect()->route('admin.tasas.list', ['nav' => 'rate', 'action' => 'list']);
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
    public function edit($nav, $action, $id_rates)
    {
        $main_menu = $this->menu_principal();
        $query = \DB::table('ad_rates as ar')
            ->join('ad_coverages as ac', 'ac.id', '=', 'ar.ad_coverage_id')
            ->join('ad_retailer_products as arp', 'arp.id', '=', 'ar.ad_retailer_product_id')
            ->join('ad_retailers as aret', 'aret.id', '=', 'arp.ad_retailer_id')
            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
            ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
            ->select('ar.id as id_rates', 'ar.rate_company', 'ar.rate_bank', 'ar.rate_final', 'ap.name as product', 'ac.name as coverage', 'aret.name as retailer')
            ->where('ar.id', '=', $id_rates)
            ->first();
        return view('admin.tasas.edit', compact('nav', 'action', 'query', 'main_menu', 'id_rates'));
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
            $query_update = \DB::table('ad_rates')
                ->where('id', $request->get('id_rates'))
                ->update(
                    [
                        'rate_company' => $request->get('rate_company'),
                        'rate_bank' => $request->get('rate_bank'),
                        'rate_final' => $request->get('rate_final'),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]
                );
            return redirect()->route('admin.tasas.list', ['nav' => 'rate', 'action' => 'list']);
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
            ->get();
        return response()->json($product_retailer);
    }

    public function ajax_cobertura($id_retailer_product)
    {
        $coverage = \DB::table('ad_retailer_product_coverages as arpc')
            ->join('ad_coverages as ac', 'ac.id', '=', 'arpc.ad_coverage_id')
            ->select('ac.id as id_coverage', 'ac.name as coverage')
            ->where('arpc.ad_retailer_product_id', '=', $id_retailer_product)
            ->whereNotExists(function ($query_two) use ($id_retailer_product){
                $query_two->select(\DB::raw(1))
                    ->from('ad_rates as ar')
                    ->whereRaw('ar.ad_coverage_id = ac.id')
                    ->whereRaw('ar.ad_retailer_product_id = '.$id_retailer_product);
            })->get();
        //dd($coverage);
        return response()->json($coverage);
    }
}
