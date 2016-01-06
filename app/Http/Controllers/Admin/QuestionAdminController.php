<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Sibas\Entities\Question;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class QuestionAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action)
    {
        if($action=='list'){
            $query = Question::get();
            //dd($query);
            return view('admin.questions.list', compact('nav', 'action', 'query'));
        }elseif($action=='new'){
            return view('admin.questions.new', compact('nav', 'action'));
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
        $query = new Question();
        $query->question=$request->input('txtQuestion');
        if($query->save()) {
            return redirect()->route('admin.questions.list', ['nav'=>'question', 'action'=>'list']);
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

        $query = Question::where('id', $id_question)->first();
        //dd($query);
        return view('admin.questions.edit', compact('nav', 'action', 'query'));

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
        $query_update = Question::where('id', $request->input('id_question'))->first();
        $query_update->question=$request->input('txtQuestion');
        if($query_update->save()){
            return redirect()->route('admin.questions.list', ['nav'=>'question', 'action'=>'list']);
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
