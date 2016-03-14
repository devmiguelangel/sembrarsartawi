<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class ModalityAdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action, $id_retailer_product)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        if($action=='list'){
            $query_list = \DB::table('ad_modalities')
                                ->orderBy('modality','asc')
                                ->orderBy('order', 'asc')
                                ->get();
            //dd($query_list);
            $query_cant = \DB::table('ad_modalities')
                ->orderBy('modality','asc')
                ->orderBy('order', 'asc')
                ->where('modality','=', 'MV')
                ->get();
            $num_records=count($query_cant);
            return view('admin.vi.modality.list', compact('nav', 'action', 'id_retailer_product', 'query_list', 'main_menu', 'array_data', 'num_records'));
        }elseif($action=='new'){
            return view('admin.vi.modality.new', compact('nav', 'action', 'id_retailer_product', 'main_menu', 'array_data'));
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
        $modality = $request->get('id_modality');

        if($modality=='MS'){
            $rank_min = 0;
            $rank_max = 0;
        }elseif($modality=='MV'){
            $rank_min = $request->get('rank-min');
            $rank_max = $request->get('rank-max');
        }

        try {
            $query_select = \DB::table('ad_modalities')
                ->where('modality',$modality)
                ->get();
            $cont = count($query_select);
            $num = $cont+1;
            $query_insert = \DB::table('ad_modalities')->insert(
                [
                    'ad_retailer_product_id' => $request->get('id_retailer_product'),
                    'modality' => $modality,
                    'order' => $num,
                    'rank_min' => $rank_min,
                    'rank_max' => $rank_max,
                    'amount' => $request->get('amount'),
                    'amount_min' => $request->get('amount-min'),
                    'amount_max' => $request->get('amount-max'),
                    'active' => $request->get('active'),
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]
            );
            return redirect()->route('admin.vi.modality.list', ['nav' => 'modality', 'action' => 'list', 'id_retailer_product' => $request->get('id_retailer_product')])->with(array('ok' => 'Se registro correctamente los datos del formulario'));
        }catch(QueryException $e) {
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
    public function edit($nav, $action, $id_retailer_product, $id_modality)
    {
        $main_menu = $this->menu_principal();
        $array_data = $this->array_data();
        $query_edit = \DB::table('ad_modalities')
                            ->where('id',$id_modality)
                            ->first();
        return view('admin.vi.modality.edit', compact('nav', 'action', 'id_retailer_product', 'id_modality', 'main_menu', 'array_data', 'query_edit'));
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
        $modality = $request->get('modality_code');

        if($modality=='MS'){
            $rank_min = 0;
            $rank_max = 0;
        }elseif($modality=='MV'){
            $rank_min = $request->get('rank-min');
            $rank_max = $request->get('rank-max');
        }

        try {
            $query_update = \DB::table('ad_modalities')
                ->where('id', $request->get('id_modality'))
                ->where('ad_retailer_product_id',$request->get('id_retailer_product'))
                ->update(
                    [
                        'rank_min' => $rank_min,
                        'rank_max' => $rank_max,
                        'amount' => $request->get('amount'),
                        'amount_min' => $request->get('amount-min'),
                        'amount_max' => $request->get('amount-max'),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]
                );
            if($modality=='MV'){
                $query_update_all = \DB::table('ad_modalities')
                     ->where('modality',$modality)
                     ->where('id','<>',$request->get('id_modality'))
                     ->update([
                         'amount_min' => $request->get('amount-min'),
                         'amount_max' => $request->get('amount-max'),
                         'updated_at' => date("Y-m-d H:i:s")
                     ]);
            }
            return redirect()->route('admin.vi.modality.list', ['nav' => 'modality', 'action' => 'list', 'id_retailer_product'=>$request->get('id_retailer_product')])->with(array('ok' => 'Se edito correctamente los datos del formulario'));
        }catch (QueryException $e){
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

    /*PROCESOS AJAX*/
    public function ajax_modality($id_modality)
    {
        if($id_modality=='MS'){
            $query_ms = \DB::table('ad_modalities')
                            ->where('modality','=',$id_modality)
                            ->first();
            if(count($query_ms)==0){
                return '0';
            }else{
                return '1|'.$query_ms->active;
            }
        }elseif($id_modality=='MV'){
            $query_mv = \DB::table('ad_modalities')
                ->where('modality','=',$id_modality)
                ->first();
            if(count($query_mv)==0){
                return '0|0|0';
            }else{
                return '1|'.$query_mv->amount_min.'|'.$query_mv->amount_max.'|'.$query_mv->active;
            }
        }
    }

    //ACTIVAR DESACTIVAR REGISTRO
    public function ajax_active_inactive($id_modality, $modality_code, $text){

        if($text=='inactive'){
            try {
                if ($modality_code == 'MS') {
                    $query_update = \DB::table('ad_modalities')
                        ->where('id', $id_modality)
                        ->update(['active' => false]);
                    $query_modify = \DB::table('ad_modalities')
                        ->where('modality', '=', 'MV')
                        ->update(['active' => true]);
                } elseif ($modality_code == 'MV') {
                    $query_modify = \DB::table('ad_modalities')
                        ->where('modality', '=', 'MS')
                        ->update(['active' => true]);
                    $query_modify = \DB::table('ad_modalities')
                        ->where('modality', '=', 'MV')
                        ->update(['active' => false]);
                }
                return '1|Se actualizo correctamente el registro';
            }catch(QueryException $e) {
                return '0|'.$e->getMessage();
            }

        }elseif($text=='active'){
            //dd($modality_code);
            try {
                if ($modality_code == 'MS') {
                    $query_update = \DB::table('ad_modalities')
                        ->where('id', $id_modality)
                        ->update(['active' => true]);
                    $query_modify = \DB::table('ad_modalities')
                        ->where('modality', '=', 'MV')
                        ->update(['active' => false]);
                } elseif ($modality_code == 'MV') {
                    $query_modify = \DB::table('ad_modalities')
                        ->where('modality', '=', 'MS')
                        ->update(['active' => false]);
                    $query_update = \DB::table('ad_modalities')
                        ->where('modality', '=', 'MV')
                        ->update(['active' => true]);
                }
                //dd($query_modify);

                return '1|Se actualizo correctamente el registro';
            }catch(QueryException $e) {
                return '0|'.$e->getMessage();
            }
        }
    }

    //ELIMINACION DE REGISTRO
    public function ajax_delete($id_modality)
    {
        try{
            $query_del = \DB::table('ad_modalities')
                ->where('id', $id_modality)->delete();
            return '1|Se elimino correctamente el registro';
        }catch (QueryException $e){
            return '0|'.$e->getMessage();
        }
    }
}
