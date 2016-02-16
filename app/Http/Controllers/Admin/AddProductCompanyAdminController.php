<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sibas\Entities\Company;
use Sibas\Http\Requests;


class AddProductCompanyAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_company)
    {
        $main_menu = $this->menu_principal();
        if($action=='list'){
           $query = \DB::table('ad_company_products as acp')
                        ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                        ->join('ad_companies as ac', 'ac.id', '=', 'acp.ad_company_id')
                        ->select('acp.id as id_company_product', 'ap.name as product', 'ac.name as company', 'acp.active', 'acp.ad_product_id')
                        ->where('acp.ad_company_id', '=', $id_company)
                        ->get();

           return view('admin.addproductcompany.list', compact('nav', 'action', 'main_menu', 'query', 'id_company'));
        }elseif($action=='new'){
            $query_cia = Company::where('id', $id_company)->first();
            $query_prod = \DB::table('ad_products as ap')
                                ->whereNotExists(function ($query_two) use ($id_company) {
                                    $query_two->select(\DB::raw(1))
                                        ->from('ad_company_products as acp')
                                        ->whereRaw('acp.ad_product_id = ap.id')
                                        ->whereRaw('acp.ad_company_id ='.$id_company);
                                })->get();
            //dd($query_prod);
            return view('admin.addproductcompany.new', compact('nav', 'action', 'main_menu', 'id_company', 'query_cia', 'query_prod'));
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
        $query_insert = \DB::table('ad_company_products')
                            ->insert([
                                        'ad_company_id'=>$request->input('id_company'),
                                        'ad_product_id'=>$request->input('id_product'),
                                        'active'=>true
                                    ]);
        if($query_insert){
            return redirect()->route('admin.addproductcompany.list', ['nav'=>'addprocom', 'action'=>'list', 'id_company'=>$request->input('id_company')]);
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
    public function ajax_active_inactive($id_company_product, $text){
        if($text=='inactive'){
            $query_update = \DB::table('ad_company_products')
                ->where('id', $id_company_product)
                ->update(['active' => false]);
            //dd($query_update);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }elseif($text=='active'){
            $query_update = \DB::table('ad_company_products')
                ->where('id', $id_company_product)
                ->update(['active' => true]);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }
    }
}
