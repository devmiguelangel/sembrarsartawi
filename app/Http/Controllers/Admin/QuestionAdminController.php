<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Entities\Question;
use Sibas\Http\Requests;


class QuestionAdminController extends BaseController
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
            $query = Question::get();
            //dd($query);
            return view('admin.questions.list', compact('nav', 'action', 'query','main_menu','array_data'));
        }
    }

    public function index_retailer($nav, $action, $id_retailer_product, $code_product)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        return view('admin.questions.new', compact('nav', 'action', 'main_menu', 'id_retailer_product', 'code_product', 'array_data'));
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
        try {
            $query = new Question();
            $query->question = $request->input('txtQuestion');
            if ($query->save()) {
                if ($request->input('id_retailer_product') != 0) {
                    if ($request->input('code_product') == 'de') {
                        return redirect()->route('admin.de.addquestion.new', ['nav' => 'addquestion', 'action' => 'new', 'id_retailer_product' => $request->input('id_retailer_product')]);
                    } elseif ($request->input('code_product') == 'vi') {
                        return redirect()->route('admin.vi.addquestion.new', ['nav' => 'addquestionvi', 'action' => 'new', 'id_retailer_product' => $request->input('id_retailer_product')]);
                    } else {
                        return redirect()->route('admin.questions.list', ['nav' => 'question', 'action' => 'list'])->with(array('ok' => 'Se registro correctamente los datos del formulario'));
                    }
                } else {
                    return redirect()->route('admin.questions.list', ['nav' => 'question', 'action' => 'list'])->with(array('ok' => 'Se registro correctamente los datos del formulario'));
                }
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
    public function edit($nav, $action, $id_question)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $query = Question::where('id', $id_question)->first();
        //dd($query);
        return view('admin.questions.edit', compact('nav', 'action', 'query', 'main_menu', 'array_data'));

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
            $query_update = Question::where('id', $request->input('id_question'))->first();
            $query_update->question = $request->input('txtQuestion');
            if ($query_update->save()) {
                return redirect()->route('admin.questions.list', ['nav' => 'question', 'action' => 'list'])->with(array('ok' => 'Se edito correctamente los datos del formulario'));
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
}
