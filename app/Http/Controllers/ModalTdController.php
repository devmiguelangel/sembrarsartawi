<?php

namespace Sibas\Http\Controllers;

use Illuminate\Http\Request;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class ModalTdController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * ajax modal
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax_modal($id_retailer_product, $id_header, $text, $type)
    {

        //Query Builder
        $query = \DB::table('ad_retailer_products as arp')->join('ad_retailers as ar', 'ar.id', '=',
                'arp.ad_retailer_id')->join('ad_company_products as acp', 'acp.id', '=',
                'arp.ad_company_product_id')->join('ad_companies as ac', 'ac.id', '=',
                'acp.ad_company_id')->join('ad_products as ap', 'ap.id', '=',
                'acp.ad_product_id')->select('ac.name as company', 'ac.image as img_company', 'ap.name as name_product',
                'ar.name as retailer', 'ar.image as img_retailer', 'ap.code as code_product')->where('arp.id',
                $id_retailer_product)->first();

        $query_header = \DB::table('op_td_headers as th')->join('ad_users as au', 'au.id', '=',
                'th.ad_user_id')->join('ad_cities as ac', 'ac.id', '=', 'au.ad_city_id')->select('th.issue_number',
                'th.quote_number', 'th.prefix', 'th.policy_number', 'th.operation_number', 'th.validity_start',
                'th.validity_end', 'th.payment_method', 'th.currency', 'th.term', 'th.type_term', 'th.issued',
                'th.date_issue', 'th.canceled', 'th.facultative', 'th.facultative_observation', 'th.approved',
                'th.rejected', 'th.total_premium', 'th.created_at', 'ac.name as place', 'th.op_client_id',
                'ac.name as place')->where('th.id', $id_header)->first();
        //dd($query_header);

        $query_parameter = \DB::table('ad_product_parameters')->where('ad_retailer_product_id',
                $id_retailer_product)->where('slug', '=', 'FA')->first();

        $query_client = \DB::table('op_clients as cl')->join('ad_activities as aa', 'aa.id', '=',
                'cl.ad_activity_id')->select('cl.first_name', 'cl.last_name', 'cl.mother_last_name', 'cl.married_name',
                'cl.civil_status', 'cl.locality', 'cl.home_address', 'cl.home_number', 'cl.avenue_street',
                'cl.business_address', 'cl.occupation_description', 'cl.phone_number_home', 'cl.phone_number_office',
                'cl.phone_number_mobile', 'aa.occupation', 'cl.dni', 'cl.complement', 'cl.extension')->where('cl.id',
                $query_header->op_client_id)->first();
        //dd($query_client);

        $query_riesgo = \DB::table('op_td_details as td')
            ->select('td.matter_description', 'td.city', 'td.zone', 'td.locality', 'td.address',
                'td.insured_value', 'td.rate', 'td.premium', 'td.matter_insured', 'td.use',
                'td.number')
            ->where('td.op_td_header_id', '=', $id_header)
            ->get();

        $query_change_rate = \DB::table('ad_exchange_rates')->first();

        if ($type == 'PDF') {

            $view = \View::make('cert.base',
                compact('query', 'query_header', 'query_client', 'query_parameter', 'query_riesgo', 'query_change_rate',
                    'id_retailer_product', 'id_header', 'text', 'type'))->render();
            $pdf  = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('Letter');

            return $pdf->stream('certificado_slip');

        } elseif ($type == 'IMPR') {

            $response = view('cert.base',
                compact('query', 'query_header', 'query_client', 'query_parameter', 'query_riesgo', 'query_change_rate',
                    'id_retailer_product', 'id_header', 'text', 'type'));

            return response()->json([
                'payload' => $response->render()
            ]);
        }

    }
}
