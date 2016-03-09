<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use DB;

class McQuestionnairesController extends BaseController {

    public $nav = '';

    public function __construct() {
        //edw-->$this->nav = 'mcQuestionnaries';
        $this->nav = 'mcCertificate';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nav = $this->nav;
        $action='list';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $entities = DB::table('mc_questionnaires')->get();
        
        return view('admin.mcQuestionnaries.list', compact('nav', 'action', 'entities', 'main_menu', 'array_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nav = $this->nav;
        $action = 'new';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        return view('admin.mcQuestionnaries.new', compact('nav', 'action', 'main_menu', 'permissions', 'array_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $mcQuestionnaries = DB::table('mc_questionnaires')->insert(
                ['title' => $request->get('title')]
        );
        return redirect()->route('mcQuestionnariesList')->with('new', 'message');
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
    public function edit($id) {
        $nav = $this->nav;
        $action = 'edit';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $entity = DB::table('mc_questionnaires')->where('id', $id)->get();
        $entity = $entity[0];

        return view('admin.mcQuestionnaries.edit', compact('nav', 'action', 'entity', 'main_menu', 'id', 'array_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $query_update = \Sibas\Entities\McQuestionnaires::where('id', $id)->first();
        $query_update->title = $request->input('title');
        $query_update->save();

        return redirect()->route('mcQuestionnariesList')->with('edit', 'message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        \Sibas\Entities\McQuestionnaires::where('id', $id)->delete();
        return redirect()->route('mcQuestionnariesList')->with('delete', 'message');
    }

}
