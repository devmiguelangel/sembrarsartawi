<?php

namespace Sibas\Http\Controllers\Admin;

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

        if($action=='list'){
            $company_new = Company::get();

            return view('admin.company.list', compact('nav', 'action', 'company_new', 'main_menu'));
        }elseif($action=='new'){
            return view('admin.company.new', compact('nav', 'action', 'main_menu'));
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
        //
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
        $query = \DB::table('ad_companies')
                      ->where('id', '=', $id_company)
                      ->first();
        return view('admin.company.edit', compact('nav', 'action', 'query', 'main_menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
