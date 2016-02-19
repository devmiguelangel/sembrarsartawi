<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\ExchangeRate;
use Sibas\Entities\Retailer;
use Sibas\Http\Requests;


class ExchangeAdminController extends BaseController
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
            $exchange = ExchangeRate::join('ad_retailers', 'ad_exchange_rates.ad_retailer_id', '=', 'ad_retailers.id')
                ->select('ad_retailers.name as entidad', 'ad_exchange_rates.usd_value', 'ad_exchange_rates.bs_value', 'ad_exchange_rates.created_at as creation_date', 'ad_exchange_rates.id')
                ->where('ad_retailers.active', '=', 1)->get();
            //dd($exchange);
            return view('admin.exchange.list', compact('nav', 'action', 'exchange', 'main_menu'));
        }elseif($action=='new'){
            $retailer = Retailer::get();
            //dd($retailer);
            return view('admin.exchange.new', compact('nav', 'action', 'retailer', 'main_menu'));
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
        try {
            $exchange_new = new ExchangeRate();
            $exchange_new->ad_retailer_id = $request->input('id_retailer');
            $exchange_new->usd_value = $request->input('valor_usd');
            $exchange_new->bs_value = $request->input('valor_bs');
            if ($exchange_new->save()) {
                return redirect()->route('admin.exchange.list', ['nav' => 'exchange', 'action' => 'list'])->with(array('ok' => 'Se registro correctamente los datos del formulario'));
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
    public function edit($nav, $action, $id_exchange)
    {
        $main_menu = $this->menu_principal();
        $retailer = Retailer::where('active', 1)->first();
        $query_exchange = \DB::table('ad_exchange_rates')
                                ->where('id', $id_exchange)
                                ->where('ad_retailer_id',$retailer->id)
                                ->first();
        return view('admin.exchange.edit', compact('nav', 'action', 'retailer', 'main_menu', 'query_exchange', 'id_exchange'));
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
            $query_update = \DB::table('ad_exchange_rates')
                ->where('id', $request->input('id_exchange'))
                ->update(['bs_value' => $request->input('valor_bs')]);
            if ($query_update) {
                return redirect()->route('admin.exchange.list', ['nav' => 'exchange', 'action' => 'list'])->with(array('ok' => 'Se edito correctamente los datos del formulario'));
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
