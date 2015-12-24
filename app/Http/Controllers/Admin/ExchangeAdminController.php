<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sibas\Entities\ExchangeRate;
use Sibas\Entities\Retailer;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class ExchangeAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nav, $action)
    {
        if($action=='list'){
            $exchange = ExchangeRate::join('ad_retailers', 'ad_exchange_rates.ad_retailer_id', '=', 'ad_retailers.id')
                ->select('ad_retailers.name as entidad', 'ad_exchange_rates.usd_value', 'ad_exchange_rates.bs_value', 'ad_exchange_rates.created_at as creation_date', 'ad_exchange_rates.id')
                ->where('ad_retailers.active', '=', 1)->get();
            //dd($exchange);
            return view('admin.exchange.list', compact('nav', 'action', 'exchange'));
        }elseif($action=='new'){
            $retailer = Retailer::where('active', 1)->first();
            //dd($retailer);
            return view('admin.exchange.new', compact('nav', 'action', 'retailer'));
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
        $exchange_new = new ExchangeRate();
        $exchange_new->ad_retailer_id=$request->input('id_retailer');
        $exchange_new->usd_value=$request->input('valor_usd');
        $exchange_new->bs_value=$request->input('valor_bs');
        if($exchange_new->save()){
            return redirect()->route('admin.exchange.list', ['nav'=>'exchange', 'action'=>'list']);
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
