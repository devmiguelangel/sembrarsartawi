<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class SubProductAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_retailer_product_select)
    {
        $main_menu = $this->menu_principal();
        $query = \DB::table('ad_retailer_products as arp')
                    ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                    ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                    ->select('arp.id as id_retailer_product', 'arp.ad_company_product_id', 'arp.type', 'ap.name as product')
                    ->get();
        $product = array();
        $subproduct = array();
        foreach($query as $key => $value){
            if($value->type=='MP'){
                $product[] = $value->id_retailer_product.'|'.$value->product;
            }elseif($value->type=='SP'){
                $subproduct[] = $value->ad_company_product_id.'|'.$value->product;
            }
        }

        $retailer = \DB::table('ad_retailers')
                        ->where('active', true)
                        ->get();

        $retailer_subproduct = \DB::table('ad_retailer_subproducts')
                                    ->where('ad_retailer_product_id', $id_retailer_product_select)
                                    ->get();

        return view('admin.subproduct.list', compact('nav', 'action', 'product', 'subproduct', 'main_menu', 'retailer', 'retailer_subproduct', 'id_retailer_product_select', 'retailer_subproduct'));
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
            $query_del = \DB::table('ad_retailer_subproducts')
                ->where('ad_retailer_product_id', $request->input('id_retailer_product'))->delete();

            foreach ($request->get('subproduct') as $key => $value) {
                $query_product_subproduct = \DB::table('ad_retailer_subproducts')->insert(
                    [
                        'ad_retailer_product_id' => $request->input('id_retailer_product'),
                        'ad_company_product_id' => $value,
                        'active' => true,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ]
                );
            }
            return redirect()->route('admin.subproduct.list', ['nav' => 'subproduct', 'action' => 'list', 'id_retailer_product_select'=>$request->input('id_retailer_product')])->with(array('ok'=>'Se agrego correctamente los datos al producto'));

        } catch(QueryException $e){
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
    public function update(Request $request)
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

    //AJAX

    public function ajax_subproduct($id_retailer_product)
    {
        $query_subproduct = \DB::table('ad_retailer_subproducts as arsp')
            ->select('arsp.ad_company_product_id as id_company_subprod')
            ->where('arsp.ad_retailer_product_id',$id_retailer_product)
            ->get();
        //dd($query);
        $retailer_product = \DB::table('ad_retailer_products as arp')
            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
            ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
            ->select('arp.ad_company_product_id', 'arp.type', 'ap.name as product')
            ->where('arp.type', '=', 'SP')
            ->get();
        $arr = array();
        $arr['retsp'] = $query_subproduct;
        $arr['retpr'] = $retailer_product;
        return response()->json($arr);
    }
}
