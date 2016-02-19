<?php

namespace Sibas\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Sibas\Http\Controllers\PdfController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class slipModalController extends Controller {

    /**
     * @var PdfController
     */
    protected $pdf;

    public function __construct(PdfController $pdf) {

        $this->pdf = $pdf;
    }

    /**
     * funcion retorna ajax
     * @param \Illuminate\Http\Request $request
     * @return int
     */
    public function ajaxBuscar(Request $request) {
        $var = $this->returnHtmlModal($request->get('type'), $request->get('id_header'));

        if (count($var['cli']) > 0)
            return response()->json($var['html']);

        return 0;
    }
    
    /**
     * 
     * @param type $type
     * @param type $idHeader
     * @return Response
     */
    public function generaPdf($type, $idHeader){
        $var = $this->returnHtmlModal($type, decode($idHeader));
        set_time_limit(0);
        return $this->pdf->create($var['html']['template_cert'], $type);
    }
    
    public function returnHtmlModal($type,$idHeader){
        $var = '';
        switch ($type) {
            case 'cotizacion':
                $cli = array();
                $cli = \Sibas\Entities\De\Header::where('id', $idHeader)->first();
                $var = array('template_cert' => view('cert.cert_cotizacion', compact('cli', 'idHeader', 'type'))->render());
                break;
            case 'emision':
                $cli = array();
                $cli = \Sibas\Entities\De\Header::where('id', $idHeader)->first();

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
                
                $var = array('template_cert' => view('cert.cert_emision', compact('cli', 'question', 'adRates', 'idHeader', 'type'))->render());
                break;
            case 'sub_vida_emision':
                
                $deDetail = \Sibas\Entities\De\Detail::where('op_de_header_id', $idHeader)->first();
                $viDetail = \Sibas\Entities\Vi\Detail::where('op_client_id', $deDetail->op_client_id)->first();
                $viHeader = \Sibas\Entities\Vi\Header::where('id', $viDetail->op_vi_header_id)->first();
                
                $cli = $viDetail;
                $var = array('template_cert' => view('cert.cert_emision_vida', compact('viDetail', 'viHeader', 'idHeader', 'type'))->render());
                break;
            
            case 'print_all':
                $cli = array();
                $cli = \Sibas\Entities\De\Header::where('id', $idHeader)->first();

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
                $deDetail = \Sibas\Entities\De\Detail::where('op_de_header_id', $idHeader)->first();
                
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
                
                $var = array('template_cert' => view('cert.cert_all', compact('cli', 'question', 'adRates', 'viDetail', 'viHeader', 'flag', 'idHeader', 'type'))->render());
                
                break;
            default:
                break;
        }
        $arr = array('html'=>$var, 'cli'=>$cli);
        return $arr;
    }

}
