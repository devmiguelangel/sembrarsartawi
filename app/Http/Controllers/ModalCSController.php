<?php

namespace Sibas\Http\Controllers;

use Illuminate\Http\Request;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class ModalCSController extends Controller
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
        $query = \DB::table('ad_retailer_products as arp')
            ->join('ad_retailers as ar', 'ar.id', '=', 'arp.ad_retailer_id')
            ->join('ad_company_products as acp', 'acp.id', '=', 'arp.ad_company_product_id')
            ->join('ad_companies as ac', 'ac.id', '=', 'acp.ad_company_id')
            ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
            ->select('ac.name as company', 'ac.image as img_company', 'ap.name as name_product',
                'ar.name as retailer', 'ar.image as img_retailer', 'ap.code as code_product', 'arp.type as type_product')
            ->where('arp.id', decode($id_retailer_product))
            ->first();
        $code_product = $query->code_product;

        if($code_product=='td'){

            $query_header = \DB::table('op_td_headers as th')
                ->join('ad_users as au', 'au.id', '=', 'th.ad_user_id')
                ->join('ad_cities as ac', 'ac.id', '=', 'au.ad_city_id')
                ->select('th.issue_number', 'th.quote_number', 'th.prefix', 'th.policy_number', 'th.operation_number', 'th.validity_start',
                    'th.validity_end', 'th.payment_method', 'th.currency', 'th.term', 'th.type_term', 'th.issued',
                    'th.date_issue', 'th.canceled', 'th.facultative', 'th.facultative_observation', 'th.approved',
                    'th.rejected', 'th.total_premium', 'th.created_at', 'ac.name as place', 'th.op_client_id',
                    'ac.name as place')
                ->where('th.id', decode($id_header))
                ->first();
            //dd($query_header);

            $query_parameter = \DB::table('ad_product_parameters')
                ->where('ad_retailer_product_id', decode($id_retailer_product))
                ->where('slug', '=', 'FA')
                ->first();

            $query_client = \DB::table('op_clients as cl')
                ->join('ad_activities as aa', 'aa.id', '=', 'cl.ad_activity_id')
                ->select('cl.first_name', 'cl.last_name', 'cl.mother_last_name', 'cl.married_name',
                'cl.civil_status', 'cl.locality', 'cl.home_address', 'cl.home_number', 'cl.avenue_street',
                'cl.business_address', 'cl.occupation_description', 'cl.phone_number_home', 'cl.phone_number_office',
                'cl.phone_number_mobile', 'aa.occupation', 'cl.dni', 'cl.complement', 'cl.extension')
                ->where('cl.id', $query_header->op_client_id)
                ->first();
            //dd($query_client);

            $query_riesgo = \DB::table('op_td_details as td')
                ->leftJoin('op_td_facultatives as tf', 'tf.op_td_detail_id', '=', 'td.id')
                ->select('td.matter_description', 'td.city', 'td.zone', 'td.locality', 'td.address',
                    'td.insured_value', 'td.rate', 'td.premium', 'td.matter_insured', 'td.use',
                    'td.number', 'tf.approved', 'tf.surcharge', 'tf.percentage', 'tf.current_rate',
                    'tf.final_rate', 'tf.observation')
                ->where('td.op_td_header_id', '=', decode($id_header))
                ->get();

        }elseif($code_product=='au'){

            $query_header = \DB::table('op_au_headers as auh')
                ->join('ad_users as au', 'au.id', '=', 'auh.ad_user_id')
                ->join('ad_cities as ac', 'ac.id', '=', 'au.ad_city_id')
                ->select('auh.op_client_id', 'auh.issue_number', 'auh.quote_number', 'auh.prefix',
                    'auh.issue_number', 'auh.quote_number', 'auh.policy_number', 'auh.operation_number', 'auh.validity_start',
                    'auh.validity_end', 'auh.payment_method','auh.currency', 'auh.term', 'auh.type_term', 'auh.issued',
                    'auh.date_issue', 'auh.canceled', 'auh.facultative', 'auh.facultative_observation', 'auh.approved',
                    'auh.rejected', 'auh.total_premium', 'auh.share', 'auh.created_at', 'ac.name as place')
                ->where('auh.id',decode($id_header))
                ->first();

            $year = $this->getFullYearAttribute($query_header->term,$query_header->type_term);

            $query_parameter = \DB::table('ad_product_parameters')
                ->where('ad_retailer_product_id',decode($id_retailer_product))
                ->first();

            $query_client = \DB::table('op_clients')
                ->where('id',$query_header->op_client_id)
                ->first();

            $query_car = \DB::table('op_au_details as aud')
                ->join('ad_vehicle_types as avt', 'avt.id', '=', 'aud.ad_vehicle_type_id')
                ->join('ad_vehicle_makes as avma', 'avma.id', '=', 'aud.ad_vehicle_make_id')
                ->join('ad_vehicle_models as avmo', 'avmo.id', '=', 'aud.ad_vehicle_model_id')
                ->join('ad_retailer_product_categories as rpc', 'rpc.id', '=', 'aud.ad_retailer_product_category_id')
                ->leftjoin('op_au_facultatives as af', 'af.op_au_detail_id', '=', 'aud.id')
                ->select('avt.vehicle', 'avma.make', 'avmo.model', 'rpc.category', 'aud.year', 'aud.license_plate',
                    'aud.use', 'aud.mileage', 'aud.color', 'aud.engine', 'aud.chassis', 'aud.tonnage_capacity', 'aud.seat_number',
                    'aud.insured_value', 'aud.rate', 'aud.premium', 'aud.approved', 'aud.rejected', 'aud.ad_vehicle_type_id',
                    'af.approved', 'af.surcharge', 'af.percentage', 'af.current_rate', 'af.final_rate', 'af.observation')
                ->where('aud.op_au_header_id', decode($id_header))
                ->get();
            //dd($query_car);

            $query_vht = array();
            $vehicle_type = \DB::table('ad_vehicle_types')
                ->where('active',true)
                ->get();
            $i=1;
            foreach($vehicle_type as $data_vhit){
                $query_vht[$i] = $data_vhit->id.'|'.$data_vhit->vehicle;
                $i++;
            }
        }elseif($code_product=='de'){
            $query_header = \DB::table('op_de_headers as dh')
                ->join('ad_users as au', 'au.id', '=', 'dh.ad_user_id')
                ->join('ad_cities as ac', 'ac.id', '=', 'au.ad_city_id')
                ->join('ad_agencies as ag', 'ag.id', '=', 'au.ad_agency_id')
                ->join('ad_coverages as cov', 'cov.id', '=', 'dh.ad_coverage_id')
                ->join('ad_credit_products as acp', 'acp.id', '=', 'dh.ad_credit_product_id')
                ->select('dh.quote_number', 'dh.issue_number', 'dh.prefix', 'dh.policy_number', 'dh.operation_number',
                'dh.movement_type', 'cov.name as coverage', 'cov.slug as slug_coverage', 'dh.amount_requested',
                'dh.currency', 'dh.term', 'dh.type_term', 'dh.total_rate', 'dh.total_premium', 'dh.issued',
                'dh.date_issue', 'dh.canceled', 'dh.facultative', 'dh.facultative_observation', 'dh.approved',
                'dh.rejected', 'dh.created_at', 'acp.name as credit_product', 'ac.name as city', 'ag.name as agency',
                'au.id as user_id', 'acp.slug as slug_credit_product', 'au.full_name')
                ->where('dh.id', '=', decode($id_header))
                ->first();

            /*DETALLES */
            $query_details = \DB::table('op_de_details as dd')
                ->join('op_clients as cl', 'cl.id', '=', 'dd.op_client_id')
                ->join('ad_activities as ac', 'ac.id', '=', 'cl.ad_activity_id')
                ->join('op_de_responses as dr', 'dr.op_de_detail_id', '=', 'dd.id')
                ->join('op_de_beneficiaries as odb', 'odb.op_de_detail_id', '=', 'dd.id')
                ->leftjoin('ad_cities as cit', 'cit.slug', '=', 'cl.place_residence')
                ->leftjoin('op_de_facultatives as df', 'df.op_de_detail_id', '=', 'dd.id')
                ->select('cl.first_name', 'cl.last_name', 'cl.mother_last_name', 'cl.married_name', 'cl.civil_status',
                'cl.birth_place', 'cl.country', 'cit.name as city', 'cl.birthdate', 'cl.place_residence', 'cl.dni', 'cl.age', 'cl.height',
                'cl.weight', 'cl.home_address', 'cl.phone_number_office', 'cl.phone_number_home', 'cl.document_type', 'ac.occupation',
                'cl.occupation_description', 'cl.complement', 'cl.extension', 'dr.response', 'dr.observation',
                'cl.gender', 'dd.percentage_credit', 'dd.id', 'dd.headline', 'dd.amount', 'dd.cumulus', 'dd.balance', 'df.reason',
                'df.approved', 'df.surcharge', 'df.percentage', 'df.current_rate', 'df.final_rate', 'df.observation',
                'cl.id as id_client', 'cl.id as id_client', 'cl.email', 'cl.phone_number_mobile', 'cl.business_address',
                'cl.home_address', 'cl.home_number', 'cl.hand', 'odb.first_name as be_first_name', 'odb.last_name as be_last_name',
                'odb.mother_last_name as be_mother_last_name', 'odb.dni as be_dni', 'odb.extension as be_extension',
                'odb.relationship as be_relationship')
                ->where('dd.op_de_header_id', decode($id_header))
                ->get();
            //dd($query_details);
            /*PARAMETROS PRODUCTO*/
            $query_parameter = \DB::table('ad_product_parameters')
                ->where('ad_retailer_product_id', decode($id_retailer_product))
                ->where('slug', '=', 'GE')
                ->first();


            /*PREGUNTAS/RESPUESTAS CLIENTES*/
            $i = 1;

            $question = array();
            $facul_q = array();
            $imc_arr = array();
            foreach ($query_details as $value) {
                $facul_q['fac'][$i]=true;
                foreach (json_decode($value->response) as $key => $data) {
                    if($data->expected != $data->response){
                        $facul_q['fac'][$i]=false;
                    }
                    $question[$data->question][$i] = $data->response;
                }
                $result = explode('|',$this->getImcStatusAttribute($value->weight,$value->height));
                $imc_arr['imc'][$i]=$result[0];
                $imc_arr['status'][$i]=$result[1];
                $i++;
            }
            //dd($question);
            /*BENEFICIARIOS*/
            $beneficiary=array();
            $client = 1;
            foreach($query_details as $data_detail){
                $query_beneficiary = \DB::table('op_de_beneficiaries')
                    ->where('op_de_detail_id', $data_detail->id)
                    ->get();
                foreach($query_beneficiary as $data_benef){
                    $beneficiary[$client]=array('coverage'=>$data_benef->coverage, 'first_name'=>$data_benef->first_name, 'last_name'=>$data_benef->last_name,
                        'mother_last_name'=>$data_benef->mother_last_name, 'dni'=>$data_benef->dni, 'extension'=>$data_benef->extension,
                        'age'=>$data_benef->age, 'relationship'=>$data_benef->relationship);
                }
                $client = $client + 1;
            }

            /*SUB-PRODUCTOS*/
            $arr_benefi_subp = array();
            $active_subprod = 0;
            foreach($query_details as $data_cl){
                $query_quest_cl = \DB::table('op_vi_details as vd')
                    ->join('op_vi_headers as vh', 'vh.id', '=', 'vd.op_vi_header_id')
                    ->join('op_clients as cl', 'cl.id', '=', 'vd.op_client_id')
                    ->join('ad_activities as ac', 'ac.id', '=', 'cl.ad_activity_id')
                    ->join('op_vi_responses as vr', 'vr.op_vi_detail_id', '=', 'vd.id')
                    ->select('cl.first_name', 'cl.last_name', 'cl.mother_last_name', 'cl.birth_place', 'cl.birthdate',
                        'cl.dni', 'cl.extension', 'cl.age', 'cl.weight', 'cl.height', 'cl.home_address', 'cl.email', 'cl.phone_number_home',
                        'cl.phone_number_office', 'cl.phone_number_mobile', 'ac.occupation', 'cl.business_address', 'vr.response',
                        'vd.id as id_detail', 'vh.prefix', 'vh.issue_number');
                foreach($query_details as $key=>$data_det){
                    if($key==0){
                        $query_quest_cl=$query_quest_cl->where('vd.op_client_id', $data_det->id_client);
                    }elseif($key==1){
                        $query_quest_cl=$query_quest_cl->orWhere('vd.op_client_id', $data_det->id_client);
                    }
                }
                $query_quest_cl=$query_quest_cl->where('vh.issued', true)
                    ->where('vh.canceled', false)
                    ->orderBy('vh.issue_number', 'asc')
                    ->get();
                if(count($query_quest_cl)>0){
                    //dd($query_quest_cl);
                    $l = 1;
                    foreach($query_quest_cl as $data_detailvi){
                        $query_beneficiary_subp=\DB::table('op_vi_beneficiaries')
                            ->where('op_vi_detail_id',$data_detailvi->id_detail)
                            ->get();
                        $v = 1;
                        foreach($query_beneficiary_subp as $data_benef){
                            $arr_benefi_subp[$l][$v]=array('coverage'=>$data_benef->coverage, 'first_name'=>$data_benef->first_name,
                                'last_name'=>$data_benef->mother_last_name, 'mother_last_name'=>$data_benef->mother_last_name,
                                'dni'=>$data_benef->dni, 'extension'=>$data_benef->extension, 'relationship'=>$data_benef->relationship,
                                'participation'=>$data_benef->participation);
                            $v = $v + 1;
                        }
                        $l = $l + 1;
                    }

                }
            }

            $query_subproduct = \DB::table('ad_retailer_subproducts as rsp')
                ->join('ad_company_products as acp', 'acp.id', '=', 'rsp.ad_company_product_id')
                ->join('ad_products as ap', 'ap.id', '=', 'acp.ad_product_id')
                ->select('ap.code as code_product')
                ->where('rsp.ad_retailer_product_id', decode($id_retailer_product))
                ->first();
            $sub_product_code = $query_subproduct->code_product;

        }elseif($code_product=='vi'){
            /*DETALLES */
            $query_details = \DB::table('op_de_details as dd')
                ->join('op_clients as cl', 'cl.id', '=', 'dd.op_client_id')
                ->join('ad_activities as ac', 'ac.id', '=', 'cl.ad_activity_id')
                ->join('op_de_responses as dr', 'dr.op_de_detail_id', '=', 'dd.id')
                ->leftjoin('op_de_facultatives as df', 'df.op_de_detail_id', '=', 'dd.id')
                ->select('cl.first_name', 'cl.last_name', 'cl.mother_last_name', 'cl.married_name', 'cl.civil_status',
                    'cl.birth_place', 'cl.country', 'cl.birthdate', 'cl.place_residence', 'cl.dni', 'cl.age', 'cl.height',
                    'cl.weight', 'cl.home_address', 'cl.phone_number_office', 'cl.phone_number_home', 'ac.occupation',
                    'cl.occupation_description', 'cl.complement', 'cl.extension', 'dr.response', 'dr.observation',
                    'cl.gender', 'dd.percentage_credit', 'dd.id', 'dd.headline', 'dd.amount', 'dd.cumulus', 'df.reason',
                    'df.approved', 'df.surcharge', 'df.percentage', 'df.current_rate', 'df.final_rate', 'df.observation',
                    'cl.id as id_client', 'cl.id as id_client', 'cl.email', 'cl.phone_number_mobile', 'cl.business_address')
                ->where('dd.op_de_header_id', decode($id_header))
                ->get();

            /*SUB-PRODUCTOS*/
            $arr_benefi_subp = array();
            $active_subprod = 0;
            foreach($query_details as $data_cl){
                $query_quest_cl = \DB::table('op_vi_details as vd')
                    ->join('op_vi_headers as vh', 'vh.id', '=', 'vd.op_vi_header_id')
                    ->join('op_clients as cl', 'cl.id', '=', 'vd.op_client_id')
                    ->join('ad_activities as ac', 'ac.id', '=', 'cl.ad_activity_id')
                    ->join('op_vi_responses as vr', 'vr.op_vi_detail_id', '=', 'vd.id')
                    ->select('cl.first_name', 'cl.last_name', 'cl.mother_last_name', 'cl.birth_place', 'cl.birthdate',
                    'cl.dni', 'cl.extension', 'cl.age', 'cl.weight', 'cl.height', 'cl.home_address', 'cl.email', 'cl.phone_number_home',
                    'cl.phone_number_office', 'cl.phone_number_mobile', 'ac.occupation', 'cl.business_address', 'vr.response',
                    'vd.id as id_detail', 'vh.prefix', 'vh.issue_number');
                foreach($query_details as $key=>$data_det){
                    if($key==0){
                        $query_quest_cl=$query_quest_cl->where('vd.op_client_id', $data_det->id_client);
                    }elseif($key==1){
                        $query_quest_cl=$query_quest_cl->orWhere('vd.op_client_id', $data_det->id_client);
                    }
                }
                $query_quest_cl=$query_quest_cl->where('vh.issued', true)
                    ->where('vh.canceled', false)
                    ->orderBy('vh.issue_number', 'asc')
                    ->get();
                if(count($query_quest_cl)>0){
                    //dd($query_quest_cl);
                    $l = 1;
                    foreach($query_quest_cl as $data_detailvi){
                        $query_beneficiary_subp=\DB::table('op_vi_beneficiaries')
                            ->where('op_vi_detail_id',$data_detailvi->id_detail)
                            ->get();
                        $v = 1;
                        foreach($query_beneficiary_subp as $data_benef){
                            $arr_benefi_subp[$l][$v]=array('coverage'=>$data_benef->coverage, 'first_name'=>$data_benef->first_name,
                                'last_name'=>$data_benef->last_name, 'mother_last_name'=>$data_benef->mother_last_name,
                                'dni'=>$data_benef->dni, 'extension'=>$data_benef->extension, 'relationship'=>$data_benef->relationship,
                                'participation'=>$data_benef->participation);
                            $v = $v + 1;
                        }
                        $l = $l + 1;
                    }
                }
            }
        }

        $query_change_rate = \DB::table('ad_exchange_rates')->first();

        if ($type == 'PDF') {
            if($code_product=='td'){
                $view = \View::make('cert.base',
                    compact('query', 'query_header', 'query_client', 'query_parameter', 'query_riesgo', 'query_change_rate',
                        'id_retailer_product', 'id_header', 'text', 'type', 'code_product'))->render();
            }elseif($code_product=='au'){
                $view =  \View::make('cert.base',
                    compact('query', 'query_header', 'query_parameter', 'query_client', 'year', 'query_car', 'query_vht',
                        'id_retailer_product', 'id_header', 'text', 'type', 'code_product'))->render();
            }elseif($code_product=='de'){
                $view =  \View::make('cert.base',
                    compact('query', 'query_header', 'query_parameter', 'query_details', 'id_retailer_product', 'id_header',
                        'facul_q', 'imc_arr', 'question', 'beneficiary', 'active_subprod', 'arr_id_client', 'sub_product_code',
                        'sub_product_code', 'query_quest_cl', 'arr_benefi_subp', 'text', 'type', 'code_product'))->render();
            }elseif($code_product=='vi'){
                $view =  \View::make('cert.base',
                    compact('query', 'query_quest_cl', 'arr_benefi_subp', 'id_retailer_product', 'id_header',
                        'text', 'type', 'code_product'))->render();
            }

            $pdf  = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('Letter');

            return $pdf->stream('certificado_slip.pdf');

        } elseif ($type == 'IMPR') {
            if ($code_product=='td'){
                $response = view('cert.base',
                    compact('query', 'query_header', 'query_client', 'query_parameter', 'query_riesgo', 'query_change_rate',
                        'id_retailer_product', 'id_header', 'text', 'type', 'code_product'));
            }elseif($code_product=='au'){
                $response = view('cert.base',
                    compact('query', 'query_header', 'query_parameter', 'query_client', 'year', 'query_car', 'query_vht',
                        'id_retailer_product', 'id_header', 'text', 'type', 'code_product'));
            }elseif($code_product=='de'){
                $response = view('cert.base',
                    compact('query', 'query_header', 'query_parameter', 'query_details', 'id_retailer_product', 'id_header',
                        'facul_q', 'imc_arr', 'question', 'beneficiary', 'active_subprod', 'arr_id_client', 'sub_product_code',
                        'sub_product_code', 'query_quest_cl', 'arr_benefi_subp', 'text', 'type', 'code_product'));
            }elseif($code_product=='vi'){
                $response = view('cert.base',
                    compact('query', 'query_quest_cl', 'arr_benefi_subp', 'id_retailer_product', 'id_header',
                        'text', 'type', 'code_product'));
            }
            return response()->json([
                'payload' => $response->render()
            ]);
        }

    }

    public function getFullYearAttribute($term,$type_term)
    {
        switch ($type_term) {
            case 'Y':
                return $term;
                break;
            case 'M':
                return round($term / 12, 0, PHP_ROUND_HALF_UP);
                break;
            case 'D':
                return round($term / 365, 0, PHP_ROUND_HALF_UP);
                break;
            default:
                return 0;
                break;
        }
    }

    public function getImcStatusAttribute($weight,$height)
    {
        $imc = '';

        $result = ceil($weight / (($height / 100) * ($height / 100)));

        if ($result < 18) {
            $imc = true.'|Desnutricion';
        } elseif (($result >= 18) and ($result <= 24)) {
            $imc = false.'|Saludable';
        } elseif (($result >= 25) and ($result <= 29)) {
            $imc = false.'|Sobrepeso aceptable';
        } elseif (($result >= 30) and ($result <= 39)) {
            $imc = true.'|Obeso';
        } elseif ($result >= 40){
            $imc = true.'|Obesidad morbida';
        }
        return $imc;

    }
}
