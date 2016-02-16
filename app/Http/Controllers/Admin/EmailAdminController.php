<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Sibas\Entities\Email;
use Sibas\Http\Requests;


class EmailAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action)
    {
        $main_menu = $this->menu_principal();
        if($action=='list_epr'){
            $query = \DB::table('ad_retailer_product_emails as arpe')
                        ->join('ad_emails as am', 'am.id', '=', 'arpe.ad_email_id')
                        ->join('ad_retailer_products as arp', 'arp.id', '=', 'arpe.ad_retailer_product_id')
                        ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                        ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                        ->select('am.email', 'am.name', 'ap.name as product', 'arpe.active', 'arpe.id', 'arpe.ad_email_id')
                        ->where('arp.active', true)
                        ->where('acp.active', true)
                        ->get();
            //dd($query);
            return view('admin.email.list-email-product-retailer', compact('nav', 'action', 'main_menu', 'query'));
        }elseif($action=='new_add_email'){
            $query = \DB::table('ad_retailer_products as arp')
                            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                            ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                            ->select('arp.id as id_retailer_product', 'ap.name as product', 'ap.code')
                            ->get();
            $query_email = \DB::table('ad_emails')
                                ->get();
            return view('admin.email.new-add-email', compact('nav', 'action', 'main_menu', 'query', 'query_email'));
        }elseif($action=='new_email'){
            return view('admin.email.new-email', compact('nav', 'action', 'main_menu'));
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
        $query_insert = \DB::table('ad_retailer_product_emails')->insert(
            [
                'ad_retailer_product_id'=>$request->input('id_product_retail'),
                'ad_email_id'=>$request->input('id_email'),
                'active'=>true,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ]
        );
        if($query_insert){
            return redirect()->route('admin.email.list-email-product-retailer', ['nav'=>'email', 'action'=>'list_epr']);
        }
    }

    public function store_new_email(Request $request)
    {
        $query_insert = \DB::table('ad_emails')->insert(
            [
                'email'=>$request->input('txtEmail'),
                'name'=>$request->input('txtNombre'),
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ]
        );
        if($query_insert){
            return redirect()->route('admin.email.new-add-email', ['nav'=>'email', 'action'=>'new_add_email']);
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
    public function edit($nav, $action, $ad_email_id)
    {
        $main_menu = $this->menu_principal();
        $query = \DB::table('ad_emails')
                        ->where('id',$ad_email_id)
                        ->first();
        //dd($query);
        return view('admin.email.edit-email', compact('nav', 'action', 'query', 'ad_email_id', 'main_menu'));
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
        // save image data into database //
        $query_update = Email::where('id', $request->input('ad_email_id'))->first();
        $query_update->name=$request->input('txtNombre');
        $query_update->email=$request->input('txtEmail');
        $query_update->updated_at=date("Y-m-d H:i:s");
        if($query_update->save()){
            return redirect()->route('admin.email.list-email-product-retailer', ['nav'=>'email', 'action'=>'list_epr']);
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
    public function ajax_active_inactive($id_retailer_product_email, $text){
        //dd($id_company);
        if($text=='inactive'){
            $query_update = \DB::table('ad_retailer_product_emails')
                ->where('id', $id_retailer_product_email)
                ->update(['active' => false]);
            //dd($query_update);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }elseif($text=='active'){
            $query_update = \DB::table('ad_retailer_product_emails')
                ->where('id', $id_retailer_product_email)
                ->update(['active' => true]);
            if($query_update) {
                return 1;
            }else{
                return 0;
            }
        }
    }


    public function ajax_quest_data($id_email, $id_product_retailer)
    {
        $query = \DB::table('ad_retailer_product_emails')
            ->where('ad_retailer_product_id', $id_product_retailer)
            ->where('ad_email_id', $id_email)
            ->first();
        //dd(count($query));
        if(count($query)>0){
            return 1;
        }else{
            return 0;
        }
    }

    public function ajax_quest_email($email)
    {
        $query = \DB::table('ad_emails')
            ->where('email', $email)
            ->first();
        //dd(count($query));
        if(count($query)>0){
            return 1;
        }else{
            return 0;
        }
    }
}
