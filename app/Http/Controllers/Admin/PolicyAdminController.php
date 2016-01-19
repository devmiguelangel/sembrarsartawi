<?php

namespace Sibas\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Sibas\Http\Requests;


class PolicyAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_retailer_products, $id_company)
    {
        $main_menu = $this->menu_principal();
        if($action=='list'){
            $query = \DB::table('ad_policies')
                ->where('ad_retailer_product_id', $id_retailer_products)
                ->get();

            $query_prod = \DB::table('ad_retailer_products as arp')
                ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                ->select('ap.name as product')
                ->where('arp.id',$id_retailer_products)
                ->first();
            //dd($query);
            return view('admin.policy.list', compact('nav', 'action', 'id_company', 'main_menu', 'query', 'id_retailer_products', 'query_prod'));
        }elseif($action=='new'){
            $query_prod = \DB::table('ad_retailer_products as arp')
                ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                ->select('ap.name as product')
                ->where('arp.id',$id_retailer_products)
                ->first();
            //dd($id_retailer_products);
            return view('admin.policy.new', compact('nav', 'action', 'id_company', 'main_menu', 'id_retailer_products', 'query_prod'));
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

        //dd();
        $query_insert = \DB::table('ad_policies')->insert(
            [
                 'ad_retailer_product_id'=>$request->input('id_retailer_products'),
                 'number'=> $request->input('txtNumPoliza'),
                 'end_policy' => $request->input('txtEndPoliza'),
                 'date_begin' => new Carbon(str_replace('/','-',$request->input('fechaini'))),
                 'date_end' => new Carbon(str_replace('/','-',$request->input('fechafin'))),
                 'created_at' => date("Y-m-d H:i:s"),
                 'updated_at' => date("Y-m-d H:i:s"),
                 'active' => false
            ]
        );
        if($query_insert){
            return redirect()->route('admin.policy.list', ['nav'=>'policynumber', 'action'=>'list', 'id_company'=>$request->input('id_company'), 'id_retailer_products'=>$request->input('id_retailer_products')]);
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
    public function edit($nav, $action, $id_policies, $id_company, $id_retailer_products)
    {
        $main_menu = $this->menu_principal();
        $query_policy = \DB::table('ad_policies')
                    ->where('id', $id_policies)
                    ->where('ad_retailer_product_id', $id_retailer_products)
                    ->first();
        //dd($query);
        $query_prod = \DB::table('ad_retailer_products as arp')
                        ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                        ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                        ->select('ap.name as product')
                        ->where('arp.id',$id_retailer_products)
                        ->first();
        return view('admin.policy.edit', compact('nav', 'action', 'id_company', 'main_menu', 'query_policy', 'id_retailer_products', 'query_prod', 'id_policies'));
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
        $query_update = \DB::table('ad_policies')
            ->where('id', $request->input('id_policies'))
            ->update([
                'number' => $request->input('txtNumPoliza'),
                'end_policy' => $request->input('txtEndPoliza'),
                'date_begin'=>new Carbon(str_replace('/','-',$request->input('fechaini'))),
                'date_end'=>new Carbon(str_replace('/','-',$request->input('fechafin')))
                ]);
        //dd($query_update);
        if($query_update) {
            return redirect()->route('admin.policy.list', ['nav'=>'policynumber', 'action'=>'list', 'id_company'=>$request->input('id_company'), 'id_retailer_products'=>$request->input('id_retailer_products')]);
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

    /**
     * ajax
     *
     * procesos ajax
     */
    public function ajax_active_inactive($id_policies, $text){
        //dd($id_company);
        if($text=='inactive'){
            $query_update = \DB::table('ad_policies')
                ->where('id', $id_policies)
                ->update(['active' => false]);
            //dd($query_update);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }elseif($text=='active'){
            $query_update = \DB::table('ad_policies')
                ->where('id', $id_policies)
                ->update(['active' => true]);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }
    }
}
