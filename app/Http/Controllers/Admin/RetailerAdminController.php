<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


use Sibas\Entities\Retailer;
use Sibas\Http\Requests;

class RetailerAdminController extends BaseController
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
            $query = \DB::table('ad_retailers')->get();
            //dd($query);
            return view('admin.retailer.list', compact('nav', 'action', 'query', 'main_menu', 'array_data'));
        }elseif($action=='new'){
            return view('admin.retailer.new', compact('nav', 'action', 'main_menu', 'array_data'));
        }
        //
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
        $this->validate($request, [
            'txtFile' => 'mimes:jpeg,jpg,png'
        ]);


        $especiales = array("ñ", "Ñ", "á", "Á", "é", "É", "í", "Í", "ó", "Ó", "ú", "Ú", "ü", "Ü", " ");
        $reemplazos = array("n", "N", "a", "A", "e", "E", "i", "I", "o", "O", "u", "U", "u", "U", "-");
        $slug = str_replace($especiales, $reemplazos, $request->input('txtRetailer'));
        //dd($request->file('txtFile'));
        $file = $request->file('txtFile');
        $destination_path = 'assets/files/';
        $file_id = date('U') . '_' . md5(uniqid('@F#1$' . time(), true));
        $filename = $file_id . '.' . $file->getClientOriginalExtension();
        $file->move($destination_path, $filename);
        $field_image = $destination_path . $filename;

        // save image data into database //
        try {
            $query_update = new Retailer();
            $query_update->name = $request->input('txtRetailer');
            $query_update->image = $field_image;
            $query_update->domain = $request->input('txtDominio');
            $query_update->slug = strtolower($slug);
            $query_update->active = true;
            if($query_update->save()) {
                return redirect()->route('admin.retailer.list', ['nav' => 'retailer', 'action' => 'list'])->with(array('ok' => 'Se agrego correctamente los datos del formulario'));
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
    public function edit($nav, $action, $id_retailer)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $query = \DB::table('ad_retailers')
                    ->where('id', '=', $id_retailer)
                    ->first();
        return view('admin.retailer.edit', compact('nav', 'action', 'query', 'main_menu', 'array_data'));
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
        $this->validate($request, [
            'txtFile' => 'mimes:jpeg,jpg,png'
        ]);

        //dd($request->file('txtFile'));
        if(count($request->file('txtFile'))>0){
            // upload the image //
            $file = $request->file('txtFile');
            $destination_path = 'assets/files/';
            $file_id = date('U') . '_' . md5(uniqid('@F#1$' . time(), true));
            $filename = $file_id . '.' . $file->getClientOriginalExtension();
            $file->move($destination_path, $filename);
            $field_image = $destination_path . $filename;
        }else{
            $field_image = $request->input('aux_file');
        }

        try{
            // save image data into database //
            $query_update = Retailer::where('id', $request->input('id_retailer'))->first();
            $query_update->name=$request->input('txtRetailer');
            $query_update->image=$field_image;
            $query_update->domain=$request->input('txtDominio');
            if($query_update->save()) {
                return redirect()->route('admin.retailer.list', ['nav' => 'retailer', 'action' => 'list'])->with(array('ok' => 'Se edito correctamente los datos del formulario'));
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
     * ajax
     *
     * procesos ajax
     */
    public function ajax_active_inactive($id_retailer, $text){
        if($text=='inactive'){
            $query_update = \DB::table('ad_retailers')
                ->where('id', $id_retailer)
                ->update(['active' => false]);
            //dd($query_update);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }elseif($text=='active'){
            $query_update = \DB::table('ad_retailers')
                ->where('id', $id_retailer)
                ->update(['active' => true]);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }
    }
}
