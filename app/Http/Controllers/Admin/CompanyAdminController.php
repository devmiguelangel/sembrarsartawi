<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\Company;
use Sibas\Http\Requests;


class CompanyAdminController extends BaseController
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
            $company_new = Company::get();

            return view('admin.company.list', compact('nav', 'action', 'company_new', 'main_menu', 'array_data'));
        }elseif($action=='new'){
            return view('admin.company.new', compact('nav', 'action', 'main_menu', 'array_data'));
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
            'txtFile' => 'required|mimes:jpeg,jpg,png'
        ]);

        //dd($request->file('txtFile'));

        // upload the image //
        $especiales = array("ñ", "Ñ", "á", "Á", "é", "É", "í", "Í", "ó", "Ó", "ú", "Ú", "ü", "Ü", " ");
        $reemplazos = array("n", "N", "a", "A", "e", "E", "i", "I", "o", "O", "u", "U", "u", "U", "-");
        $slug = str_replace($especiales, $reemplazos, $request->input('txtCompany'));

        $file = $request->file('txtFile');
        $destination_path = 'assets/files/';
        $file_id = date('U') . '_' . md5(uniqid('@F#1$' . time(), true));
        $filename = $file_id . '.' . $file->getClientOriginalExtension();
        $file->move($destination_path, $filename);
        $field_image = $destination_path . $filename;


        try {
            // save image data into database //
            $query_update = new Company();
            $query_update->name = $request->input('txtCompany');
            $query_update->image = $field_image;
            $query_update->slug = $slug;
            $query_update->active = true;
            if ($query_update->save()) {
                return redirect()->route('admin.company.list', ['nav' => 'company', 'action' => 'list'])->with(array('ok' => 'Se creo correctamente el registro'));
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
    public function edit($nav, $action, $id_company)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $query = \DB::table('ad_companies')
                      ->where('id', '=', $id_company)
                      ->first();
        return view('admin.company.edit', compact('nav', 'action', 'query', 'main_menu', 'array_data'));
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
        try {
            // save image data into database //
            $query_update = Company::where('id', $request->input('id_company'))->first();
            $query_update->name = $request->input('txtCompany');
            $query_update->image = $field_image;
            if ($query_update->save()) {
                return redirect()->route('admin.company.list', ['nav' => 'company', 'action' => 'list'])->with(array('ok' => 'Se edito correctamente los datos del formulario'));
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
    public function ajax_active_inactive($id_company, $text){
        //dd($id_company);
        if($text=='inactive'){
            $query_update = \DB::table('ad_companies')
                ->where('id', $id_company)
                ->update(['active' => false]);
            //dd($query_update);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }elseif($text=='active'){
            $query_update = \DB::table('ad_companies')
                ->where('id', $id_company)
                ->update(['active' => true]);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }
    }
}
