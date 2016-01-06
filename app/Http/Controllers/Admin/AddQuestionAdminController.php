<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class AddQuestionAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_retailer_product)
    {
        $query = \DB::table('ad_retailer_products')
                    ->where('id', '=', $id_retailer_product)
                    ->where('active', '=', true)
                    ->first();
        /*
        $query_cia = \DB::table('ad_company_products')
                        ->join('ad_companies', 'ad_companies.id', '=', 'ad_company_products.ad_company_id')
                        ->join('ad_products', 'ad_products.id', '=', 'ad_company_products.ad_product_id')
                        ->select('ad_products.name as producto', 'ad_companies.name as compania')
                        ->where('ad_company_products.id', '=', $query->ad_company_product_id)
                        ->where('ad_companies.active', '=', true)
                        ->first();
        */
        $query_list_q = \DB::table('ad_retailer_product_questions')
                            ->join('ad_questions', 'ad_questions.id', '=', 'ad_retailer_product_questions.ad_question_id')
                            ->select('ad_questions.question', 'ad_retailer_product_questions.id', 'ad_retailer_product_questions.ad_question_id', 'ad_retailer_product_questions.order', 'ad_retailer_product_questions.response')
                            ->where('ad_retailer_product_id', '=', $id_retailer_product)
                            ->get();
        //dd($query_list_q);
        return view('admin.de.addquestion.list', compact('nav', 'action', 'query_list_q', 'id_retailer_product'));
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
    public function edit($id)
    {
        //
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
