<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use DB;


class AdActivitiesController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $nav='adActivitiesList';
        $action='list';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $entities = DB::table('ad_activities')->get();
        
        return view('admin.adActivities.list', compact('nav', 'action', 'entities', 'main_menu', 'array_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $nav = 'adActivitiesList';
        $action = 'new';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        return view('admin.adActivities.new', compact('nav', 'action', 'main_menu', 'array_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $activities = DB::table('ad_activities')->insert(
                ['category' => $request->get('category'), 'occupation' => $request->get('occupation'), 'code'=>$request->get('code')]
        );
        return redirect()->route('adActivitiesList')->with('new','message');
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
    public function edit($id) {
        
        $nav = 'adActivitiesList';
        $action = 'edit';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        
        
        $adActivity = DB::table('ad_activities')->where('id',$id)->get();
        $adActivity = $adActivity[0];
        
        
        return view('admin.adActivities.edit', compact('nav', 'action', 'adActivity', 'main_menu', 'id', 'array_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $query_update = \Sibas\Entities\Activity::where('id', $id)->first();
        $query_update->category=$request->input('category');
        $query_update->occupation=$request->input('occupation');
        $query_update->code=$request->input('code');
        $query_update->save();
        
        return redirect()->route('adActivitiesList')->with('edit','message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        \Sibas\Entities\Activity::where('id', $id)->delete();
        return redirect()->route('adActivitiesList')->with('delete','message');
    }

    /**
     * Import file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function import_file()
    {
        $nav = 'adActivitiesList';
        $action = 'import';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        return view('admin.adActivities.import-file', compact('nav', 'action', 'main_menu', 'array_data'));
    }

    /**
     * Upload file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload_files(Request $request)
    {

        //dd($request->file('FileInput'));

        if (Input::hasFile('FileInput')){
            $file = $request->file('FileInput');

            $destinationPath = 'assets/files/'; // upload path
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111,99999).'_'.$name; // renameing image
            $file->move($destinationPath, $fileName); // loading file to given path
            echo '¡Éxito! Archivo subido.'; echo'<br>';

            Excel::load('assets/files/'.$fileName, function($reader) {

                // Getting all results
                $results = $reader->get();
                //dd($results);
                foreach($results as $data){
                    //var_dump($data->caedec);
                    try {
                        $query_insert = \DB::table('ad_activities')->insert(
                            [
                                'occupation' => $data->ocupacion,
                                'code' => $data->caedec,
                                'created_at'=>date("Y-m-d H:i:s"),
                                'updated_at'=>date("Y-m-d H:i:s")
                            ]
                        );

                    }catch(QueryException $e){
                        echo $e->getMessage();
                    }
                }

                echo 'Se importo correctamente los datos del archivo';
            });
            unlink('assets/files/'.$fileName);
        }else{
            return redirect()->back()->with(array('error'=>'Error no se subio correctamente el archivo, intente otra vez'));
        }

    }

}
