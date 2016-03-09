<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class StateAdminController extends BaseController
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
            $query = \DB::table('ad_retailer_product_states as arps')
                        ->join('ad_retailer_products as arp', 'arp.id', '=', 'arps.ad_retailer_product_id')
                        ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                        ->join('ad_retailers as ar', 'ar.id', '=', 'arp.ad_retailer_id')
                        ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                        ->join('ad_states as sta', 'sta.id', '=', 'arps.ad_state_id')
                        ->select('arps.id as id_retailer_product_states', 'sta.state', 'ap.name as product', 'ar.name as retailer', 'arps.active')
                        ->get();

            return view('admin.estados.list', compact('nav', 'action', 'main_menu', 'query', 'array_data'));
        }elseif($action=='new'){
            $retailer = \DB::table('ad_retailers')
                ->get();
            $states = \DB::table('ad_states')
                            ->get();
            return view('admin.estados.new', compact('nav', 'action', 'main_menu', 'query', 'retailer', 'states', 'array_data'));
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
            $query_quest  = \DB::table('ad_retailer_product_states')
                                ->where('ad_retailer_product_id', $request->get('id_producto_retailer'))
                                ->get();

            if(count($query_quest)>0){
                $query_del = \DB::table('ad_retailer_product_states')
                    ->where('ad_retailer_product_id', $request->get('id_producto_retailer'))->delete();
            }

            foreach ($request->get('estados') as $key => $value) {
                $query_insert = \DB::table('ad_retailer_product_states')->insert(
                    [
                        'ad_retailer_product_id' => $request->get('id_producto_retailer'),
                        'ad_state_id' => $value,
                        'active' => true,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]
                );
            }
            return redirect()->route('admin.estados.list', ['nav' => 'state', 'action' => 'list'])->with(array('ok' => 'Se registro correctamente los datos del formulario'));
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

    public function ajax_state_retailer($id_product_retailer)
    {
        $state = \DB::table('ad_states as st')
            ->select('st.id as id_state', 'st.state')
            ->get();

        $state_retailer = \DB::table('ad_retailer_product_states')
            ->where('ad_retailer_product_id', '=', $id_product_retailer)
            ->get();
        //dd($city_retailer);
        $arr = array();
        $arr['state'] = $state;
        $arr['stateretailer'] = $state_retailer;
        return response()->json($arr);
    }

    public function ajax_states($id_product_retailer)
    {
        $state = \DB::table('ad_states as st')
            ->select('st.id as id_state', 'st.state')
            ->get();
        return response()->json($state);
    }

    public function ajax_active_inactive($id_retailer_product_states, $text){
        //dd($id_retailer_product_states);
        if($text=='inactive'){
            $query_update = \DB::table('ad_retailer_product_states')
                ->where('id', $id_retailer_product_states)
                ->update(['active' => false]);
            //dd($query_update);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }elseif($text=='active'){
            $query_update = \DB::table('ad_retailer_product_states')
                ->where('id', $id_retailer_product_states)
                ->update(['active' => true]);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }
    }
}
