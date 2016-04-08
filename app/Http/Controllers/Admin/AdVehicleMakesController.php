<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\Au\VehicleMake;

use Sibas\Http\Requests;

class AdVehicleMakesController extends BaseController
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action) {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $entities = VehicleMake::get();
        return view('admin.adVehicleMakes.list', compact('nav','action', 'entities', 'main_menu', 'array_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nav = 'ad_vehicle_makes';
        $action = 'new';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        
        return view('admin.adVehicleMakes.new', compact('nav', 'action', 'main_menu', 'array_data'));
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
            $insert = new VehicleMake();
            $insert->make = $request->input('make');
            $insert->active = ($request->input('active') == 'on')?1:0;
            
            if($insert->save()) {
                return redirect()->route('admin.vehicle_makes.list', ['nav'=>'ad_vehicle_makes', 'action'=>'list'])
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
        $entity = VehicleMake::where('id', $id)->first();
        
        return view('admin.adVehicleMakes.edit', compact('nav', 'action', 'entity', 'main_menu', 'array_data'));
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
            $update = VehicleMake::where('id', $request->input('id_vehicle_make'))->first();
            $update->make = $request->input('make');
            $update->active = $request->input('active');
            
            if($update->save()) {
                return redirect()->route('admin.vehicle_makes.list', ['nav'=>'ad_vehicle_makes', 'action'=>'list'])->with(array('ok' => 'Se edito correctamente los datos del formulario'));
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
        VehicleMake::where('id', $id)->delete();
        return redirect()->route('admin.vehicle_makes.list', ['nav'=>'ad_vehicle_makes', 'action'=>'list'])->with(array('ok' => 'Registro eliminado correctametne'));
    }
}
