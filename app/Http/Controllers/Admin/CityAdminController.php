<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Sibas\Entities\City;
use Sibas\Entities\Retailer;
use Sibas\Http\Requests;


class CityAdminController extends BaseController
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
            $query = City::get();
            //dd($query);
            return view('admin.cities.list', compact('nav', 'action', 'query', 'main_menu'));
        }elseif($action=='new'){
            $query_re = Retailer::where('active',1)->get();
            //dd($query_re);
            return view('admin.cities.new', compact('nav', 'action', 'query_re', 'main_menu'));
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
        $query_int = new City();
        $query_int->name=$request->input('txtSucursal');
        $query_int->abbreviation=$request->input('txtCodigo');
        if($query_int->save()) {
            if($request->input('id_retailer')!=0){
                $id_city=$query_int->id;
                $query_re_cit = \DB::table('ad_retailer_cities')->insert(
                    ['ad_retailer_id'=>$request->input('id_retailer'), 'ad_city_id'=>$id_city, 'active'=>true]
                );
            }
            return redirect()->route('admin.cities.list', ['nav' => 'city', 'action' => 'list']);
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
    public function edit($nav, $action, $id_depto)
    {
        $main_menu = $this->menu_principal();
        $query = City::where('id', $id_depto)->first();
        $query_re = Retailer::where('active',1)->get();
        $query_ret_city = \DB::table('ad_retailer_cities')
                            ->where('ad_city_id', $id_depto)
                            ->get();
        //dd($query_ret_city);
        return view('admin.cities.edit', compact('nav', 'action', 'query', 'query_re', 'main_menu', 'query_ret_city'));
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
        $query_update = City::where('id', $request->input('id_depto'))->first();
        $query_update->name=$request->input('txtSucursal');
        $query_update->abbreviation=$request->input('txtCodigo');
        if($query_update->save()){
            if($request->input('id_retailer')!=0){
                $query_re = \DB::table('ad_retailer_cities')
                                ->where('ad_retailer_id','=',$request->input('id_retailer'))
                                ->where('ad_city_id', '=', $request->input('id_depto'))->first();
                //dd(count($query_re));
                if(count($query_re)==0){
                    $query_int = \DB::table('ad_retailer_cities')->insert(
                        ['ad_retailer_id'=>$request->input('id_retailer'), 'ad_city_id'=>$request->input('id_depto'), 'active'=>true]
                    );
                }
                return redirect()->route('admin.cities.list', ['nav'=>'city', 'action'=>'list']);
            }else{
                return redirect()->route('admin.cities.list', ['nav'=>'city', 'action'=>'list']);
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


    /**
     FUNCIONES AJAX
     **/
    public function ajax_typeci($id_depto, $answer)
    {
        //dd($answer);
        //$query_update = City::where('id', $id_depto)->first();
        $query_update = City::find($id_depto);
        //dd($query_update);
        if($answer=='v'){
            $query_update->type_ci=true;
        }elseif($answer=='f'){
            $query_update->type_ci=false;
        }
        //dd($query_update);
        if($query_update->save()){
            return 1;
        }else{
            return 0;
        }
    }

    public function ajax_typere($id_depto, $answer)
    {
        //dd($answer);
        $query_update = City::where('id', $id_depto)->first();
        //$query_update = City::find($id_depto);
        //dd($query_update);
        if($answer=='v'){
            $query_update->type_re=true;
        }elseif($answer=='f'){
            $query_update->type_re=false;
        }
        //dd($query_update);
        if($query_update->save()){
            return 1;
        }else{
            return 0;
        }
    }

    public function ajax_typede($id_depto, $answer)
    {
        //dd($answer);
        $query_update = City::where('id', $id_depto)->first();
        //$query_update = City::find($id_depto);
        //dd($query_update);
        if($answer=='v'){
            $query_update->type_de=true;
        }elseif($answer=='f'){
            $query_update->type_de=false;
        }
        //dd($query_update);
        if($query_update->save()){
            return 1;
        }else{
            return 0;
        }
    }
}
