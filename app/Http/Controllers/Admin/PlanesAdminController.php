<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Entities\RetailerProduct;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class PlanesAdminController extends BaseController
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
            $query = \DB::table('ad_plans')
                ->where('ad_retailer_product_id', $id_retailer_product)
                ->get();
            //dd($query);
            return view('admin.vi.planes.list', compact('nav', 'action', 'id_retailer_product', 'query', 'main_menu'));
        }elseif($action=='new'){
            $query_retailer = RetailerProduct::join('ad_company_products as acp', 'acp.id', '=', 'ad_retailer_products.ad_company_product_id')
                ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                ->select('ap.name as product')
                ->where('ad_retailer_products.id',$id_retailer_product)
                ->first();
            return view('admin.vi.planes.new', compact('nav', 'action', 'main_menu', 'query_retailer', 'id_retailer_product'));
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
        $plan = array(0=>array('cov'=>$request->input('txtOp1'), 'rank'=>$request->input('txtBs1')), 1=>array('cov'=>$request->input('txtOp2'), 'rank'=>$request->input('txtBs2')), 2=>array('cov'=>$request->input('txtOp3'), 'rank'=>$request->input('txtBs3')));
        //dd($plan);
        try {
            $query_insert = \DB::table('ad_plans')->insert(
                [
                    'ad_retailer_product_id' => $request->input('id_retailer_product'),
                    'name' => $request->input('txtName'),
                    'description' => $request->input('txtDesc'),
                    'monthly_premium' => $request->input('txtPrimaM'),
                    'annual_premium' => $request->input('txtPrimaA'),
                    'plan' => json_encode($plan),
                    'minimum_age' => $request->input('edad_min'),
                    'maximum_age' => $request->input('edad_max'),
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]
            );

            return redirect()->route('admin.vi.planes.list', ['nav' => 'listplansvi', 'action' => 'list', 'id_retailer_product' => $request->input('id_retailer_product')])->with(array('ok'=>'Se registro correctamente los datos del formulario'));

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
    public function edit($nav, $action, $id_retailer_product, $id_planes)
    {
        $main_menu = $this->menu_principal();
        $query = \DB::table('ad_plans')
                    ->where('id', $id_planes)
                    ->where('ad_retailer_product_id', $id_retailer_product)
                    ->first();
        $query_retailer = RetailerProduct::join('ad_company_products as acp', 'acp.id', '=', 'ad_retailer_products.ad_company_product_id')
                                        ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                                        ->select('ap.name as product')
                                        ->where('ad_retailer_products.id',$id_retailer_product)
                                        ->first();
        //dd($query_retailer);
        return view('admin.vi.planes.edit', compact('nav', 'action', 'id_retailer_product', 'id_planes', 'main_menu', 'query', 'query_retailer'));
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

        $plan = array(0=>array('cov'=>$request->input('txtOp1'), 'rank'=>$request->input('txtBs1')), 1=>array('cov'=>$request->input('txtOp2'), 'rank'=>$request->input('txtBs2')), 2=>array('cov'=>$request->input('txtOp3'), 'rank'=>$request->input('txtBs3')));
        //dd($plan);
        try {
            $query_update = \DB::table('ad_plans')
                ->where('id', $request->input('id_planes'))
                ->where('ad_retailer_product_id', $request->input('id_retailer_product'))
                ->update([
                    'name' => $request->input('txtName'),
                    'description' => $request->input('txtDesc'),
                    'monthly_premium' => $request->input('txtPrimaM'),
                    'annual_premium' => $request->input('txtPrimaA'),
                    'plan' => json_encode($plan),
                    'minimum_age' => $request->input('edad_min'),
                    'maximum_age' => $request->input('edad_max'),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);

            return redirect()->route('admin.vi.planes.list', ['nav' => 'listplansvi', 'action' => 'list', 'id_retailer_product' => $request->input('id_retailer_product')])->with(array('ok'=>'Se actualizo correctamente los datos del formulario'));

        }catch(QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }

        //dd($escape);
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
