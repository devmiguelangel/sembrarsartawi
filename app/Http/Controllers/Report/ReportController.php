<?php

namespace Sibas\Http\Controllers\Report;

use DB;
use Illuminate\Http\Request;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class ReportController extends Controller {

    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return type
     */
    public function general(Request $request) {
        $users = DB::table('ad_users')->lists('username', 'id');
        $agencies = DB::table('ad_agencies')->lists('name', 'id');
        $cities = DB::table('ad_cities')->lists('name', 'id');
        $extencion = DB::table('ad_cities')->lists('name', 'abbreviation');
        $valueForm = $this->addValueForm($request);
        
        $opClients = DB::table('op_clients')
                ->join('op_de_details', 'op_clients.id', '=', 'op_de_details.op_client_id')
                ->select('op_de_details.op_de_header_id');
        
        $query = DB::table('op_de_headers')
                ->join('ad_users', 'op_de_headers.ad_user_id', '=', 'ad_users.id')
                ->join('ad_coverages', 'op_de_headers.ad_coverage_id', '=', 'ad_coverages.id')
                ->select('op_de_headers.*', 'ad_users.username', 'ad_users.full_name', 'ad_coverages.name')
                ->where('op_de_headers.issued',1);
        $details = array();
        $result = array();
        $flagClient = 0;
        if ($request->get('_token')) {
            
            # numero poliza
            if ($request->get('numero_poliza'))
                $query->where('op_de_headers.policy_number', $request->get('numero_poliza'));
            
            # usuario vendedor
            if ($request->get('usuario'))
                $query->where('op_de_headers.ad_user_id', $request->get('usuario'));
            
            # usuario vendedor agencia
            if ($request->get('agencia'))
                $query->where('ad_users.ad_agency_id', $request->get('agencia'));
            
            # usuario vendedor sucursal
            if ($request->get('sucursal'))
                $query->where('ad_users.ad_city_id', $request->get('sucursal'));
            
            # fecha de emision inicial
            if ($request->get('fecha_ini'))
                $query->where('op_de_headers.date_issue', '>=', date('Y-m-d',strtotime(str_replace('/', '-', $request->get('fecha_ini')))));
            
            # fecha de emision final
            if ($request->get('fecha_fin'))
                $query->where('op_de_headers.date_issue', '<=', date('Y-m-d',strtotime('+1 days',strtotime(str_replace('/', '-', $request->get('fecha_fin'))))));
            
            # extencion cliente
            if ($request->get('extension'))
                $opClients->where('op_clients.extension', $request->get('extension'));
            # ci cliente
            if ($request->get('ci'))
                $opClients->where('op_clients.dni', $request->get('ci'));
            
            # nombre cliente
            if ($request->get('cliente'))
                $opClients->where('op_clients.first_name', 'LIKE', '%'.$request->get('cliente').'%');
            
            
            if($request->get('extension') || $request->get('ci') || $request->get('cliente'))
                $flagClient = 1;
            
                $details = $opClients->get();
            
            $result = $query->get();
        }else {
            $result = $query->get();
        }
        //edw-->var_dump($details);
        
        # validacion filtra poliza enbase al cliente
        if(count($details)>0 || $flagClient==1 ){
            $idHeaders = $this->returnIdHeades($details);
            $var = array();
            foreach ($result as $key => $value) {
                if(in_array($value->id, $idHeaders))
                        $var[]=$value;
            }
            $result = $var;
        }
        return view('report.general', compact('result', 'users', 'agencies', 'cities', 'extencion','valueForm'));
    }
    
    /**
     * funcion retorna ids de polizas emitidas en formato array
     * @param type $object
     * @return type
     */
    public function returnIdHeades($object) {
        $val = array();
        if (count($object) > 0) {
            foreach ($object as $key => $value) {
                $val[] = $value->op_de_header_id;
            }
        }
        return $val;
    }
    
    public function addValueForm($request) {
        $request->get('numero_poliza');
        $arr = array(
            'numero_poliza'=>($request->get('numero_poliza'))?$request->get('numero_poliza'):'',
            'cliente'=>($request->get('cliente'))?$request->get('cliente'):'',
            'agencia'=>($request->get('agencia'))?$request->get('agencia'):'',
            'ci'=>($request->get('ci'))?$request->get('ci'):'',
            'usuario'=>($request->get('usuario'))?$request->get('usuario'):'',
            'extension'=>($request->get('extension'))?$request->get('extension'):'',
            'sucursal'=>($request->get('sucursal'))?$request->get('sucursal'):'',
            'fecha_ini'=>($request->get('fecha_ini'))?$request->get('fecha_ini'):'',
            'fecha_fin'=>($request->get('fecha_fin'))?$request->get('fecha_fin'):'',
        );
        return $arr;
    }

}
