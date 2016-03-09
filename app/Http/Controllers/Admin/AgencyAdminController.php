<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
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
    public function index($nav, $action)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='list'){
            //dd($id_retailer);
            $query = Agency::get();
            return view('admin.agencies.list', compact('nav','action', 'query', 'main_menu', 'array_data'));
        }elseif($action=='new'){

            return view('admin.agencies.new', compact('nav', 'action', 'main_menu', 'array_data'));
        }

    }


    public function index_agency_retailer($nav, $action)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='list_agency_retailer'){
            $query = \DB::table('ad_retailer_city_agencies as arca')
                ->join('ad_agencies as aa', 'aa.id', '=', 'arca.ad_agency_id')
                ->join('ad_retailer_cities as arc', 'arc.id', '=', 'arca.ad_retailer_city_id')
                ->join('ad_cities as ac', 'ac.id', '=', 'arc.ad_city_id')
                ->join('ad_retailers as ar', 'ar.id', '=', 'arc.ad_retailer_id')
                ->select('arca.id as id_retailer_city_agency', 'aa.name as agency', 'ac.name as city', 'arca.active', 'ar.name as retailer')
                ->get();
            //dd($query);
            return view('admin.agencies.list-agency-retailer', compact('nav', 'action', 'main_menu', 'query', 'array_data'));
        }elseif($action=='new_agency_retailer'){
            $agency = \DB::table('ad_agencies as aa')
                            ->select('aa.id as id_agency', 'aa.name as agency')
                            ->get();

            $retailer = \DB::table('ad_retailers as ar')
                            ->select('ar.id as id_retailer', 'ar.name as retailer')
                            ->get();

            return view('admin.agencies.new-agency-retailer', compact('nav', 'action', 'main_menu', 'agency', 'retailer', 'array_data'));
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
        $slug = Str::slug($request->input('txtAgencia'));
        try {
            $query_int = new Agency();
            $query_int->name = $request->input('txtAgencia');
            $query_int->code = $request->input('txtCodigo');
            $query_int->slug = $slug;
            if ($query_int->save()) {

                return redirect()->route('admin.agencies.list', ['nav' => 'city', 'action' => 'list'])->with(array('ok'=>'Se agrego correctamente los datos del formulario'));
            }
        }catch (QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }
    }

    public function store_agency_city(Request $request)
    {
        try {
            $quest = \DB::table('ad_retailer_city_agencies')
                        ->where('ad_retailer_city_id', $request->input('id_retailer_cities'))
                        ->get();

            if(count($quest)>0){
                $query_del = \DB::table('ad_retailer_city_agencies')
                    ->where('ad_retailer_city_id', $request->input('id_retailer_cities'))->delete();
            }

            foreach ($request->get('agencies') as $key => $value) {
                $query_retailer_city_agencies = \DB::table('ad_retailer_city_agencies')->insert(
                    [
                        'ad_retailer_city_id' => $request->input('id_retailer_cities'),
                        'ad_agency_id' => $value,
                        'active' => true,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ]
                );
            }
            return redirect()->route('admin.agencies.list-agency-retailer', ['nav' => 'agency', 'action' => 'list_agency_retailer'])->with(array('ok'=>'Se agrego correctamente los datos del formulario'));

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
    public function edit($nav, $action, $id_agency)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $query_ag = Agency::where('id', $id_agency)->first();

        //dd($city_agency);
        return view('admin.agencies.edit', compact('nav', 'action', 'query_ag', 'main_menu', 'array_data'));
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
        $slug = Str::slug($request->input('txtAgencia'));
        try {
            $query_update = Agency::where('id', $request->input('id_agency'))->first();
            $query_update->name = $request->input('txtAgencia');
            $query_update->code = $request->input('txtCodigo');
            $query_update->slug = $slug;
            if ($query_update->save()) {
                return redirect()->route('admin.agencies.list', ['nav' => 'agency', 'action' => 'list']);
            }
        }catch(QueryException $e){
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * AJAX
     */
    public function ajax_cities($id_retailer)
    {
        $cities = \DB::table('ad_retailer_cities as arc')
                        ->join('ad_cities as ac', 'ac.id', '=', 'arc.ad_city_id')
                        ->select('arc.id as id_retailer_city', 'ac.name as cities')
                        ->where('arc.ad_retailer_id', '=', $id_retailer)
                        ->where('arc.active', true)
                        ->get();
        //dd($cities);
        return response()->json($cities);
    }

    public function ajax_agencies_retailer($id_retailer_city)
    {
        $retailer_city_agencies = \DB::table('ad_retailer_city_agencies as arca')
            ->select('arca.ad_agency_id')
            ->where('arca.ad_retailer_city_id', '=', $id_retailer_city)
            ->get();

        $agencies = \DB::table('ad_agencies as aa')
            ->select('aa.id as id_agency', 'aa.name as agencies')
            ->get();
        //dd($retailer_city_agencies);
        $arr = array();
        $arr['retcityagency'] = $retailer_city_agencies;
        $arr['agenciestable'] = $agencies;
        return response()->json($arr);
    }

    public function ajax_active_inactive($id_retailer_city_agency, $text){
        //dd($id_company);
        if($text=='inactive'){
            $query_update = \DB::table('ad_retailer_city_agencies')
                ->where('id', $id_retailer_city_agency)
                ->update(['active' => false]);
            //dd($query_update);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }elseif($text=='active'){
            $query_update = \DB::table('ad_retailer_city_agencies')
                ->where('id', $id_retailer_city_agency)
                ->update(['active' => true]);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }
    }
}
