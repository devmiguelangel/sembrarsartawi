<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
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
        $array_data = $this->array_data();
        if($action=='list'){
            $query = City::get();
            //dd($query);
            return view('admin.cities.list', compact('nav', 'action', 'query', 'main_menu', 'array_data'));
        }elseif($action=='new'){
            $query_re = Retailer::where('active',1)->get();
            //dd($query_re);
            return view('admin.cities.new', compact('nav', 'action', 'query_re', 'main_menu', 'array_data'));
        }

    }

    public function index_city_retailer($nav, $action)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='list_city_retailer'){
            $query = \DB::table('ad_retailer_cities as arc')
                ->join('ad_cities as ac', 'ac.id', '=', 'arc.ad_city_id')
                ->join('ad_retailers as ar', 'ar.id', '=', 'arc.ad_retailer_id')
                ->select('arc.id as id_city_retailer', 'ac.name as cities', 'ar.name as retailer', 'arc.ad_retailer_id', 'arc.active')
                ->get();
            //dd($query);
            return view('admin.cities.list-city-retailer', compact('nav', 'action', 'query', 'main_menu', 'array_data'));
        }elseif($action=='new_city_retailer'){
            $retailer = \DB::table('ad_retailers')
                            ->get();
            $city = \DB::table('ad_cities')
                            ->where('abbreviation', '<>', 'PE')
                            ->get();
            return view('admin.cities.new-city-retailer', compact('nav', 'action', 'main_menu', 'retailer', 'city', 'array_data'));
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
        $slug = Str::slug($request->input('txtSucursal'));
        try {
            $query_int = new City();
            $query_int->name = $request->input('txtSucursal');
            $query_int->abbreviation = $request->input('txtCodigo');
            $query_int->slug = $slug;
            if ($query_int->save()) {
                return redirect()->route('admin.cities.list', ['nav' => 'city', 'action' => 'list']);
            }
        }catch (QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }
    }

    public function store_city_retailer(Request $request)
    {
        try {
            //VERIFICAMOS SI EL ID_RETAILER_CITY NO ESTA EN LA TABLA AD_RETAILER_CITY_AGENCIES
            $query_retailer_city = \DB::table('ad_retailer_cities')
                                    ->where('ad_retailer_id', '=', $request->input('id_retailer'))
                                    ->get();

            foreach($query_retailer_city as $data){
                $quest = \DB::table('ad_retailer_city_agencies')
                            ->where('ad_retailer_city_id', '=', $data->id)
                            ->first();
                //dd($quest);
                if(count($quest)==0){
                    $query_del = \DB::table('ad_retailer_cities')
                        ->where('id', $data->id)->delete();
                }
            }

            foreach ($request->get('city') as $key => $value) {
                $query_quest_city = \DB::table('ad_retailer_cities')
                                        ->where('ad_city_id', '=', $value)
                                        ->first();
                if(count($query_quest_city)==0){
                    $query_cities_retailer = \DB::table('ad_retailer_cities')->insert(
                        [
                            'ad_retailer_id' => $request->input('id_retailer'),
                            'ad_city_id' => $value,
                            'active' => true,
                            'created_at'=>date("Y-m-d H:i:s"),
                            'updated_at'=>date("Y-m-d H:i:s")
                        ]
                    );
                }
            }
            return redirect()->route('admin.cities.list-city-retailer', ['nav' => 'city', 'action' => 'list_city_retailer'])->with(array('ok'=>'Se agrego correctamente los datos del formulario'));

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
    public function edit($nav, $action, $id_depto)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $query = City::where('id', $id_depto)->first();
        $query_re = Retailer::where('active',1)->get();
        $query_ret_city = \DB::table('ad_retailer_cities')
                            ->where('ad_city_id', $id_depto)
                            ->get();
        //dd($query_ret_city);
        return view('admin.cities.edit', compact('nav', 'action', 'query', 'query_re', 'main_menu', 'query_ret_city', 'array_data'));
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
            $slug = Str::slug($request->input('txtSucursal'));
            $query_update = City::where('id', $request->input('id_depto'))->first();
            $query_update->name = $request->input('txtSucursal');
            $query_update->abbreviation = $request->input('txtCodigo');
            $query_update->slug = $slug;
            if ($query_update->save()) {
                return redirect()->route('admin.cities.list', ['nav' => 'city', 'action' => 'list']);
            }
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

    public function ajax_city_retailer($id_retailer)
    {
        $city = \DB::table('ad_cities as ac')
                    ->select('ac.id as id_city', 'ac.name as cities')
                    ->where('ac.abbreviation', '<>', 'PE')
                    ->get();

        $city_retailer = \DB::table('ad_retailer_cities as arc')
                                ->select('arc.id as id_retailer_cities', 'arc.ad_retailer_id', 'arc.ad_city_id')
                                ->where('arc.ad_retailer_id', '=', $id_retailer)
                                ->get();
        //dd($city_retailer);
        $arr = array();
        $arr['city'] = $city;
        $arr['cityretailer'] = $city_retailer;
        return response()->json($arr);
    }

    public function ajax_active_inactive($id_city_retailer, $text){
        //dd($id_company);
        if($text=='inactive'){
            $query_update = \DB::table('ad_retailer_cities')
                ->where('id', $id_city_retailer)
                ->update(['active' => false]);
            //dd($query_update);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }elseif($text=='active'){
            $query_update = \DB::table('ad_retailer_cities')
                ->where('id', $id_city_retailer)
                ->update(['active' => true]);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }
    }
}
