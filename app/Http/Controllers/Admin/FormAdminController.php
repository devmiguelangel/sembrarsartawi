<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Sibas\Http\Requests;


class FormAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_retailer_products, $code_product)
    {
        $main_menu = $this->menu_principal();
        if($action=='list'){
            $query_form = \DB::table('ad_forms as af')
                ->select('af.id as id_forms', 'af.title', 'af.file')
                ->where('af.ad_retailer_product_id', $id_retailer_products)
                ->get();
            //dd($query_form);
            $query_prod = \DB::table('ad_retailer_products as arp')
                ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
                ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                ->select('ap.name as product')
                ->where('arp.id',$id_retailer_products)
                ->where('arp.active',true)
                ->where('acp.active',true)
                ->first();
            return view('admin.formulario.list', compact('nav', 'action', 'main_menu', 'query_form', 'query_prod', 'id_retailer_products', 'code_product'));
        }elseif($action=='new'){
            return view('admin.formulario.new', compact('nav', 'action', 'main_menu', 'id_retailer_products', 'code_product'));
        }
    }

    public function index_product_retailer($nav, $action){
        $main_menu = $this->menu_principal();
        $query = \DB::table('ad_retailer_products as arp')
            ->join('ad_retailers as ar', 'ar.id', '=', 'arp.ad_retailer_id')
            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
            ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
            ->select('arp.id as id_retailer_products', 'ar.name as retailer', 'ap.name as product', 'arp.type', 'arp.active', 'ap.code')
            ->get();
        $parameter = config('base.retailer_product_types');
        return view('admin.formulario.list-product-retailer', compact('nav', 'action', 'query', 'main_menu', 'parameter'));
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

        $this->validate($request, [
            'txtFile' => 'mimes:pdf'
        ]);
        //dd($request->all());
        //dd($request->file('txtFile'));
        if (Input::hasFile('txtFile')){
            $file = $request->file('txtFile');
            //$size = $file->getSize();
            //$type = $file->getMimeType();
            //dd($file);
            $destination_path = 'assets/files/';
            $file_id = date('U') . '_' . md5(uniqid('@F#1$' . time(), true));
            $filename = $file_id . '.' . $file->getClientOriginalExtension();
            $file->move($destination_path, $filename);
            $field_image = $destination_path . $filename;

            try {
                $query_insert = \DB::table('ad_forms')->insert(
                    [
                        'ad_retailer_product_id' => $request->get('id_retailer_products'),
                        'title' => $request->get('txtTitulo'),
                        'file' => $field_image,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]
                );

                return redirect()->route('admin.formulario.list', ['nav' => 'form', 'action' => 'list', 'id_retailer_products'=>$request->get('id_retailer_products'), 'code_product'=>$request->get('code_product')])->with(array('ok' => 'Se creo correctamente el registro'));

            }catch(QueryException $e){
                return redirect()->back()->with(array('error'=>$e->getMessage()));
            }
        }else{
            return redirect()->back()->with(array('error'=>'Error no se subio correctamente el archivo, intente otra vez'));
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
    public function edit($nav, $action, $id_forms, $id_retailer_products, $code_product)
    {
        $main_menu = $this->menu_principal();
        $query_form = \DB::table('ad_forms as af')
            ->select('af.id as id_forms', 'af.title', 'af.file')
            ->where('af.ad_retailer_product_id', $id_retailer_products)
            ->where('af.id',$id_forms)
            ->first();

        return view('admin.formulario.edit', compact('nav', 'action', 'id_forms', 'id_retailer_products', 'code_product', 'query_form', 'main_menu'));
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
        $this->validate($request, [
            'txtFile' => 'mimes:pdf'
        ]);
        //dd($request->all());
        //dd($request->file('txtFile'));
        if(count($request->file('txtFile'))>0) {
            if (Input::hasFile('txtFile')) {

                $file = $request->file('txtFile');
                $destination_path = 'assets/files/';
                $file_id = date('U') . '_' . md5(uniqid('@F#1$' . time(), true));
                $filename = $file_id . '.' . $file->getClientOriginalExtension();
                $file->move($destination_path, $filename);
                $field_image = $destination_path . $filename;

                try {
                    $query_update = \DB::table('ad_forms')
                        ->where('id', $request->get('id_forms'))
                        ->where('ad_retailer_product_id', $request->get('id_retailer_products'))
                        ->update([
                            'title' => $request->get('txtTitulo'),
                            'file' => $field_image,
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);

                    return redirect()->route('admin.formulario.list', ['nav' => 'form', 'action' => 'list', 'id_retailer_products' => $request->get('id_retailer_products'), 'code_product' => $request->get('code_product')])->with(array('ok' => 'Se edito correctamente el registro'));

                } catch (QueryException $e) {
                    return redirect()->back()->with(array('error' => $e->getMessage()));
                }
            } else {
                return redirect()->back()->with(array('error' => 'Error no se subio correctamente el archivo, intente otra vez'));
            }
        }else{
            $field_image = $request->get('auxFile');
            try {
                $query_update = \DB::table('ad_forms')
                    ->where('id', $request->get('id_forms'))
                    ->where('ad_retailer_product_id', $request->get('id_retailer_products'))
                    ->update([
                        'title' => $request->get('txtTitulo'),
                        'file' => $field_image,
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);

                return redirect()->route('admin.formulario.list', ['nav' => 'form', 'action' => 'list', 'id_retailer_products' => $request->get('id_retailer_products'), 'code_product' => $request->get('code_product')])->with(array('ok' => 'Se edito correctamente el registro'));

            } catch (QueryException $e) {
                return redirect()->back()->with(array('error' => $e->getMessage()));
            }
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * AJAX
     **/
    public function ajax_delete($id_forms)
    {
        try{
            $query_del = \DB::table('ad_forms')
                ->where('id', $id_forms)->delete();
            return '1|Se elimino correctamente el registro';
        }catch (QueryException $e){
            return '0|'.$e->getMessage();
        }
    }
}
