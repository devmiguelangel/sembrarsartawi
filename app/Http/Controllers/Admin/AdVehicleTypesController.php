<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\Au\VehicleType;
use Sibas\Entities\RetailerProductCategory;
use Sibas\Http\Requests;

class AdVehicleTypesController extends BaseController
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action) {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $entities = VehicleType::get();
        return view('admin.adVehicleTypes.list', compact('nav','action', 'entities', 'main_menu', 'array_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nav = 'ad_vehicle_types';
        $action = 'new';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $category = RetailerProductCategory::get();
        
        return view('admin.adVehicleTypes.new', compact('nav', 'action', 'main_menu', 'array_data', 'category'));
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
            $insert = new VehicleType();
            $insert->vehicle = $request->input('vehicle');
            if($request->input('ad_retailer_product_category_id'))
                $insert->ad_retailer_product_category_id = $request->input('ad_retailer_product_category_id');
            $insert->percentage = $request->input('percentage');
            $insert->active = ($request->input('active') == 'on')?1:0;
            
            if($insert->save()) {
                return redirect()->route('admin.vehicle.list', ['nav'=>'ad_vehicle_types', 'action'=>'list'])
                        ->with(array('ok' => 'Se creo correctamente los datos del formulario'));
            }
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
    public function edit($nav, $action, $id)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $entity = VehicleType::where('id', $id)->first();
        $category = RetailerProductCategory::get();
        
        return view('admin.adVehicleTypes.edit', compact('nav', 'action', 'entity', 'main_menu', 'array_data', 'category'));
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
            $update = VehicleType::where('id', $request->input('id_vehicle_type'))->first();
            $update->vehicle = $request->input('vehicle');
            if($request->input('ad_retailer_product_category_id'))
                $update->ad_retailer_product_category_id = $request->input('ad_retailer_product_category_id');
            $update->percentage = $request->input('percentage');
            $update->active = ($request->input('active')=="on") ? 1: 0;
            
            if($update->save()) {
                return redirect()->route('admin.vehicle.list', ['nav'=>'ad_vehicle_types', 'action'=>'list'])->with(array('ok' => 'Se edito correctamente los datos del formulario'));
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
        VehicleType::where('id', $id)->delete();
        return redirect()->route('admin.vehicle.list', ['nav'=>'ad_vehicle_types', 'action'=>'list'])->with(array('ok' => 'Registro eliminado correctametne'));
    }
}
