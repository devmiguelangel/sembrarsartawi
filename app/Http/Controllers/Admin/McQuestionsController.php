<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use DB;

class McQuestionsController extends BaseController {

    public $nav = '';

    public function __construct() {
        //edw-->$this->nav = 'mcQuestions';
        $this->nav = 'mcCertificate';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $nav = $this->nav;
        $action = 'list';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $entities = DB::table('mc_questions')->get();
        $tipoCampo = config('base.mc_question_types');
        
        return view('admin.mcQuestions.list', compact('nav', 'action', 'entities', 'main_menu', 'tipoCampo', 'array_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $nav = $this->nav;
        $action = 'new';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $type = config('base.mc_question_types');
        $array = array();
        $i = 0;
        foreach ($type as $key => $value) {
            $array[$i]['value']=$value;
            $array[$i]['key']=$key;
            $i++;
        }
        $type = $array;
        
        return view('admin.mcQuestions.new', compact('nav', 'action', 'main_menu','type', 'array_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $mcQuestions = DB::table('mc_questions')->insert(
                ['question' => $request->get('question'), 'type' => $request->get('type')]
        );
        return redirect()->route('mcQuestionsList')->with('new', 'message');
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
        $nav = $this->nav;
        $action = 'edit';
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $type = config('base.mc_question_types');
        $array = array();
        $i = 0;
        foreach ($type as $key => $value) {
            $array[$i]['value']=$value;
            $array[$i]['key']=$key;
            $i++;
        }
        $type = $array;
        
        $entity = DB::table('mc_questions')->where('id', $id)->get();
        $entity = $entity[0];

        return view('admin.mcQuestions.edit', compact('nav', 'action', 'entity', 'main_menu', 'id', 'type', 'array_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $query_update = \Sibas\Entities\McQuestions::where('id', $id)->first();
        $query_update->question = $request->input('question');
        $query_update->type = $request->input('type');
        $query_update->save();

        return redirect()->route('mcQuestionsList')->with('edit', 'message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        \Sibas\Entities\McQuestions::where('id', $id)->delete();
        return redirect()->route('mcQuestionsList')->with('delete', 'message');
    }

}
