<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\Au\VehicleModel;
use Sibas\Entities\Au\VehicleMake;
use Sibas\Http\Requests;

class AdVehicleModelsController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_make) {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $entities = VehicleModel::where('ad_vehicle_make_id',$id_make)->get();
        $make = VehicleMake::where('id',$id_make)->first();
        return view('admin.adVehicleModels.list', compact('nav', 'action', 'entities', 'main_menu', 'array_data','make'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_make) {
        $nav = 'ad_vehicle_models';
        $action = 'new';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $make = VehicleMake::where('id',$id_make)->first();
        return view('admin.adVehicleModels.new', compact('nav', 'action', 'main_menu', 'array_data','make'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $insert = new VehicleModel();
            $insert->ad_vehicle_make_id = $request->input('ad_vehicle_make_id');
            $insert->model = $request->input('model');
            $insert->active = ($request->input('active') == 'on') ? 1 : 0;

            if ($insert->save()) {
                return redirect()->route('admin.vehicle_models.list', ['nav' => 'ad_vehicle_models', 'action' => 'list','id_make' => $request->input('ad_vehicle_make_id') ])
                                ->with(array('ok' => 'Se creo correctamente los datos del formulario'));
            }
        } catch (QueryException $e) {
            return redirect()->back()->with(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nav, $action, $id) {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $entity = VehicleModel::where('id', $id)->first();

        return view('admin.adVehicleModels.edit', compact('nav', 'action', 'entity', 'main_menu', 'array_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        try {
            $update = VehicleModel::where('id', $request->input('id_vehicle_model'))->first();
            $update->ad_vehicle_make_id = $request->input('ad_vehicle_make_id');
            $update->model = $request->input('model');
            $update->active = ($request->input('active') == 'on') ? 1 : 0;

            if ($update->save()) {
                return redirect()->route('admin.vehicle_models.list', ['nav' => 'ad_vehicle_models', 'action' => 'list', 'id_make'=>$request->input('ad_vehicle_make_id')])->with(array('ok' => 'Se edito correctamente los datos del formulario'));
            }
        } catch (QueryException $e) {
            return redirect()->back()->with(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_make) {
        VehicleModel::where('id', $id)->delete();
        return redirect()->route('admin.vehicle_models.list', ['nav' => 'ad_vehicle_models', 'action' => 'list', 'id_make' => $id_make])->with(array('ok' => 'Registro eliminado correctametne'));
    }

}
