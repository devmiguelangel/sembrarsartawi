<?php

namespace Sibas\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class slipModalController extends Controller {

    /**
     * funcion retorna ajax
     * @param \Illuminate\Http\Request $request
     * @return int
     */
    public function ajaxBuscar(Request $request) {
        switch ($request->get('type')) {
            case 'cotizacion':
                $cli = array();
                $cli = \Sibas\Entities\De\Header::where('id', $request->get('id_header'))->first();
                $var = array('template_cert' => view('cert.cert_cotizacion', compact('cli'))->render());
                break;
            case 'emision':
                $cli = array();
                $cli = \Sibas\Entities\De\Header::where('id', $request->get('id_header'))->first();

                $question = array();
                $i = 1;
                foreach ($cli->details as $key => $value) {
                    foreach (json_decode($value->response->response) as $key2 => $value2) {
                        $question[$value2->question][$i] = $value2->response;
                    }
                    $i ++;
                }
                
                $adRates = DB::table('ad_rates')->get();
                $adRates = $adRates[0];
                
                $var = array('template_cert' => view('cert.cert_emision', compact('cli', 'question', 'adRates'))->render());
                break;
            case 'sub_vida_emision':
                
                $deDetail = \Sibas\Entities\De\Detail::where('op_de_header_id', $request->get('id_header'))->first();
                $viDetail = \Sibas\Entities\Vi\Detail::where('op_client_id', $deDetail->op_client_id)->first();
                $viHeader = \Sibas\Entities\Vi\Header::where('id', $viDetail->op_vi_header_id)->first();
                
                $cli = $viDetail;
                $var = array('template_cert' => view('cert.cert_emision_vida', compact('viDetail', 'viHeader'))->render());
                break;
            
            case 'print_all':
                $cli = array();
                $cli = \Sibas\Entities\De\Header::where('id', $request->get('id_header'))->first();

                $question = array();
                $i = 1;
                foreach ($cli->details as $key => $value) {
                    foreach (json_decode($value->response->response) as $key2 => $value2) {
                        $question[$value2->question][$i] = $value2->response;
                    }
                    $i ++;
                }
                
                $adRates = DB::table('ad_rates')->get();
                $adRates = $adRates[0];
                
                # sub producto vida
                $deDetail = \Sibas\Entities\De\Detail::where('op_de_header_id', $request->get('id_header'))->first();
                
                $viDetail = 0;
                $flag = 0;
                if(count($deDetail)>0){
                    $viDetail = \Sibas\Entities\Vi\Detail::where('op_client_id', $deDetail->op_client_id)->first();
                    $flag = 1;
                }
                    
                # validacion si existe sub.producto
                $viHeader = 0;
                if(count($viDetail)>0)
                    $viHeader = \Sibas\Entities\Vi\Header::where('id', $viDetail->op_vi_header_id)->first();
                
                $var = array('template_cert' => view('cert.cert_all', compact('cli', 'question', 'adRates', 'viDetail', 'viHeader', 'flag'))->render());
                
                break;
            default:
                break;
        }

        if (count($cli) > 0)
            return response()->json($var);

        return 0;
    }

}
