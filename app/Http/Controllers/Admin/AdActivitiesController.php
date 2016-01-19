<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;

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
        $entities = DB::table('ad_activities')->get();
        
        return view('admin.adActivities.list', compact('nav', 'action', 'entities', 'main_menu'));
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
        
        return view('admin.adActivities.new', compact('nav', 'action', 'main_menu'));
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
        
        
        
        $adActivity = DB::table('ad_activities')->where('id',$id)->get();
        $adActivity = $adActivity[0];
        
        
        return view('admin.adActivities.edit', compact('nav', 'action', 'adActivity', 'main_menu', 'id'));
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

}
