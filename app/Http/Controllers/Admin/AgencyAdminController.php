<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Sibas\Entities\Agency;
use Sibas\Entities\Retailer;
use Sibas\Http\Requests;


class AgencyAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_retailer)
    {
        $main_menu = $this->menu_principal();
        if($action=='list'){
            //dd($id_retailer);
            $query = Agency::get();
            return view('admin.agencies.list', compact('nav','action', 'query', 'id_retailer', 'main_menu'));
        }elseif($action=='new'){
            $query_re = Retailer::where('id', $id_retailer)->where('active', true)->first();
            $query_dp = \DB::table('ad_retailer_cities')
                ->join('ad_cities', 'ad_cities.id', '=', 'ad_retailer_cities.ad_city_id')
                ->select('ad_cities.name as departamento', 'ad_retailer_cities.id as id_retailer_city')
                ->where('ad_retailer_cities.ad_retailer_id', '=', $id_retailer)
                ->where('ad_retailer_cities.active', '=', true)
                ->get();
            //dd($query_dp);
            return view('admin.agencies.new', compact('nav', 'action', 'id_retailer', 'query_re', 'query_dp', 'main_menu'));
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
        $query_int = new Agency();
        $query_int->name=$request->input('txtAgencia');
        $query_int->code=$request->input('txtCodigo');
        if($query_int->save()) {
            if($request->input('id_retailer_city')!=0){
                $id_agency = $query_int->id;
                $query_re_cit_ag = \DB::table('ad_retailer_city_agencies')->insert(
                    ['ad_retailer_city_id'=>$request->input('id_retailer_city'), 'ad_agency_id'=>$id_agency, 'active'=>true]
                );
            }
            return redirect()->route('admin.agencies.list', ['nav' => 'city', 'action' => 'list', 'id_retailer'=>$request->input('id_retailer')]);
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
    public function edit($nav, $action, $id_agency, $id_retailer)
    {
        $main_menu = $this->menu_principal();
        $query_re = Retailer::where('id', $id_retailer)->where('active', true)->first();
        $query_ag = Agency::where('id', $id_agency)->first();
        $query_dp = \DB::table('ad_retailer_cities')
                        ->join('ad_cities', 'ad_cities.id', '=', 'ad_retailer_cities.ad_city_id')
                        ->select('ad_cities.name as departamento', 'ad_retailer_cities.id as id_retailer_city')
                        ->where('ad_retailer_cities.ad_retailer_id', '=', $id_retailer)
                        ->where('ad_retailer_cities.active', '=', true)
                        ->get();
        //dd($query_dp);
        return view('admin.agencies.edit', compact('nav', 'action', 'query_re', 'query_ag', 'query_dp', 'main_menu'));
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
        $query_update = Agency::where('id', $request->input('id_agency'))->first();
        $query_update->name=$request->input('txtAgencia');
        $query_update->code=$request->input('txtCodigo');
        if($query_update->save()){
            if($request->input('id_retailer_city')!=0){
                $query_re_ag= \DB::table('ad_retailer_city_agencies')
                                ->where('ad_retailer_city_id', '=', $request->input('id_retailer_city'))
                                ->where('ad_agency_id', '=', $request->input('id_agency'))
                                ->first();
                if(count($query_re_ag)==0){
                    $query_int = \DB::table('ad_retailer_city_agencies')->insert(
                        ['ad_retailer_city_id'=>$request->input('id_retailer_city'), 'ad_agency_id'=>$request->input('id_agency'), 'active'=>true]
                    );
                }
                return redirect()->route('admin.agencies.list', ['nav'=>'agency', 'action'=>'list', 'id_retailer'=>$request->input('id_retailer')]);
            }else{
                return redirect()->route('admin.agencies.list', ['nav'=>'agency', 'action'=>'list', 'id_retailer'=>$request->input('id_retailer')]);
            }
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
