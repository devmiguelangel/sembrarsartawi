<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Http\Requests;

class AddQuestionAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        if($action=='list'){
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
            $query_list_q = \DB::table('ad_retailer_product_questions as arpq')
                                ->join('ad_questions as aq', 'aq.id', '=', 'arpq.ad_question_id')
                                ->select('aq.question', 'arpq.id', 'arpq.ad_question_id', 'arpq.order', 'arpq.response', 'arpq.active')
                                ->where('arpq.ad_retailer_product_id', '=', $id_retailer_product)
                                ->get();
            //dd($query_list_q);
            return view('admin.de.addquestion.list', compact('nav', 'action', 'query_list_q', 'id_retailer_product', 'main_menu'));
        }elseif($action=='new'){
            //dd($id_retailer_product);
            $query = \DB::table('ad_retailer_products')
                        ->join('ad_retailers', 'ad_retailers.id', '=', 'ad_retailer_products.ad_retailer_id')
                        ->join('ad_company_products', 'ad_company_products.id', '=', 'ad_retailer_products.ad_company_product_id')
                        ->join('ad_products', 'ad_products.id', '=', 'ad_company_products.ad_product_id')
                        ->select('ad_retailers.name as retailer', 'ad_products.name as product', 'ad_products.code')
                        ->where('ad_retailer_products.id', '=', $id_retailer_product)
                        ->where('ad_retailer_products.active', '=', true)
                        ->where('ad_retailers.active', '=', true)
                        ->first();
            //dd($query);

            $question = \DB::table('ad_questions as aq')
                            ->whereNotExists(function ($query_two) {
                                $query_two->select(\DB::raw(1))
                                            ->from('ad_retailer_product_questions as arpq')
                                            ->whereRaw('arpq.ad_question_id = aq.id');
                            })->get();
            //dd($question);
            return view('admin.de.addquestion.new', compact('nav', 'action', 'id_retailer_product', 'query', 'main_menu', 'question'));
        }

    }

    public function index_vi($nav, $action, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        if($action=='list'){
            $query = \DB::table('ad_retailer_products')
                        ->where('id', '=', $id_retailer_product)
                        ->where('active', '=', true)
                        ->first();
            //dd($query);

            $query_question = \DB::table('ad_retailer_product_questions as arpq')
                ->join('ad_questions as aq', 'aq.id', '=', 'arpq.ad_question_id')
                ->select('aq.question', 'arpq.id', 'arpq.ad_question_id', 'arpq.order', 'arpq.response', 'arpq.active')
                ->where('arpq.ad_retailer_product_id', '=', $id_retailer_product)
                ->get();
            //dd($query_question);

            return view('admin.vi.addquestion.list', compact('nav', 'action', 'id_retailer_product', 'main_menu', 'query_question'));
        }elseif($action=='new'){
            //dd($id_retailer_product);
            $query = \DB::table('ad_retailer_products')
                ->join('ad_retailers', 'ad_retailers.id', '=', 'ad_retailer_products.ad_retailer_id')
                ->join('ad_company_products', 'ad_company_products.id', '=', 'ad_retailer_products.ad_company_product_id')
                ->join('ad_products', 'ad_products.id', '=', 'ad_company_products.ad_product_id')
                ->select('ad_retailers.name as retailer', 'ad_products.name as product', 'ad_products.code')
                ->where('ad_retailer_products.id', '=', $id_retailer_product)
                ->where('ad_retailer_products.active', '=', true)
                ->where('ad_retailers.active', '=', true)
                ->first();
            //dd($query);

            $question = \DB::table('ad_questions as aq')
                ->whereNotExists(function ($query_two) {
                    $query_two->select(\DB::raw(1))
                        ->from('ad_retailer_product_questions as arpq')
                        ->whereRaw('arpq.ad_question_id = aq.id');
                })->get();
            //dd($question);
            return view('admin.vi.addquestion.new', compact('nav', 'action', 'id_retailer_product', 'query', 'main_menu', 'question'));
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
        try{
            $num = 0;
            foreach ($request->get('addquestion') as $key => $value) {
                $num = $num+1;
                if ($request->input('response') == 1) {
                    $response = true;
                } elseif ($request->input('response') == 2) {
                    $response = false;
                }

                $query_insert = \DB::table('ad_retailer_product_questions')
                    ->insert(
                        [
                            'ad_retailer_product_id' => $request->input('id_retailer_product'),
                            'ad_question_id' => $value,
                            'order' => $num,
                            'response' => $response,
                            'active' => true
                        ]
                    );
            }
            return redirect()->route('admin.de.addquestion.list', ['nav'=>'addquestion', 'action'=>'list', 'id_retailer_product'=>$request->input('id_retailer_product')]);
        }catch(QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }
    }


    public function store_vi(Request $request)
    {
        try{
            $num = 0;
            foreach ($request->get('addquestion') as $key => $value) {
                $num = $num+1;
                if ($request->input('response') == 1) {
                    $response = true;
                } elseif ($request->input('response') == 2) {
                    $response = false;
                }

                $query_insert = \DB::table('ad_retailer_product_questions')
                    ->insert(
                        [
                            'ad_retailer_product_id' => $request->input('id_retailer_product'),
                            'ad_question_id' => $value,
                            'order' => $num,
                            'response' => $response,
                            'active' => true
                        ]
                    );
            }
            return redirect()->route('admin.vi.addquestion.list', ['nav'=>'addquestionvi', 'action'=>'list', 'id_retailer_product'=>$request->input('id_retailer_product')]);
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
    public function edit($nav, $action, $id_retailer_product_question, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();

        $retailer = \DB::table('ad_retailer_products as arp')
                        ->join('ad_retailers as ar', 'ar.id', '=', 'arp.ad_retailer_id')
                        ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                        ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                        ->select('ar.name as retailer', 'ap.name as product')
                        ->where('arp.id',$id_retailer_product)
                        ->where('arp.active',true)
                        ->first();

        $query = \DB::table('ad_retailer_product_questions as arpq')
                    ->join('ad_questions as aq', 'aq.id', '=', 'arpq.ad_question_id')
                    ->select('aq.question', 'arpq.response')
                    ->where('arpq.ad_retailer_product_id',$id_retailer_product)
                    ->where('arpq.id',$id_retailer_product_question)
                    ->first();
        //dd($query);
        return view('admin.de.addquestion.edit', compact('nav', 'action', 'id_retailer_product_question', 'id_retailer_product', 'query', 'retailer', 'main_menu'));
    }


    public function edit_vi($nav, $action, $id_retailer_product_question, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();

        $retailer = \DB::table('ad_retailer_products as arp')
            ->join('ad_retailers as ar', 'ar.id', '=', 'arp.ad_retailer_id')
            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
            ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
            ->select('ar.name as retailer', 'ap.name as product')
            ->where('arp.id',$id_retailer_product)
            ->where('arp.active',true)
            ->first();

        $query = \DB::table('ad_retailer_product_questions as arpq')
            ->join('ad_questions as aq', 'aq.id', '=', 'arpq.ad_question_id')
            ->select('aq.question', 'arpq.response')
            ->where('arpq.ad_retailer_product_id',$id_retailer_product)
            ->where('arpq.id',$id_retailer_product_question)
            ->first();
        //dd($query);
        return view('admin.vi.addquestion.edit', compact('nav', 'action', 'id_retailer_product_question', 'id_retailer_product', 'query', 'retailer', 'main_menu'));
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
        if ($request->get('response') == 1) {
            $response = true;
        } elseif ($request->get('response') == 2) {
            $response = false;
        }
        try {
            $query_update = \DB::table('ad_retailer_product_questions')
                ->where('id', $request->get('id_retailer_product_question'))
                ->where('ad_retailer_product_id', $request->get('id_retailer_product'))
                ->update(['response' => $response]);
            return redirect()->route('admin.de.addquestion.list', ['nav' => 'addquestion', 'action' => 'list', 'id_retailer_product' => $request->input('id_retailer_product')]);
        }catch(QueryException $e){
            return redirect()->back()->with(array('error'=>$e->getMessage()));
        }
    }

    public function update_vi(Request $request)
    {
        if ($request->get('response') == 1) {
            $response = true;
        } elseif ($request->get('response') == 2) {
            $response = false;
        }
        try {
            $query_update = \DB::table('ad_retailer_product_questions')
                ->where('id', $request->get('id_retailer_product_question'))
                ->where('ad_retailer_product_id', $request->get('id_retailer_product'))
                ->update(['response' => $response]);
            return redirect()->route('admin.vi.addquestion.list', ['nav' => 'addquestion', 'action' => 'list', 'id_retailer_product' => $request->input('id_retailer_product')]);
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
     * ajax.
     *
     *
     * procesos ajax
     */
    public function ajax_active_inactive($id_retailer_product_question, $text){
        if($text=='inactive'){
            $query_update = \DB::table('ad_retailer_product_questions')
                                ->where('id', $id_retailer_product_question)
                                ->update(['active' => false]);
            //dd($query_update);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }elseif($text=='active'){
            $query_update = \DB::table('ad_retailer_product_questions')
                                ->where('id', $id_retailer_product_question)
                                ->update(['active' => true]);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }
    }
}
