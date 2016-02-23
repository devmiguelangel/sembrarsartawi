<?php

namespace Sibas\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use DB;

class McCertificatesController extends BaseController {

    public $nav = '';

    public function __construct() {
        $this->nav = 'mcCertificate';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $nav = $this->nav;
        $action = 'list';
        $main_menu = $this->menu_principal();
        
        $entities = DB::table('mc_certificates')
                ->join('ad_retailer_products','mc_certificates.ad_retailer_product_id','=','ad_retailer_products.id')
                ->join('ad_company_products','ad_retailer_products.ad_company_product_id','=','ad_company_products.id')
                ->join('ad_products','ad_company_products.ad_product_id','=','ad_products.id')
                ->select('mc_certificates.*','ad_products.name as name_product')
                ->get();
        $certQuest = DB::table('mc_certificate_questionnaires')->groupBy('mc_certificate_id')->get();
        $idsSelect = array();
        foreach ($certQuest as $key => $value) {
            $idsSelect[] = $value->mc_certificate_id;
            
        }
        
        foreach ($entities as $key => $value) {
            if (in_array($value->id, $idsSelect))
                $entities[$key]->questionnaire = 1;
            else
                $entities[$key]->questionnaire = 0;
        }
        
        $type = config('base.medical_certificate_types');
        
        return view('admin.mcCertificates.list', compact('nav', 'action', 'entities', 'main_menu', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $nav = $this->nav;
        $action = 'new';
        $main_menu = $this->menu_principal();
        $type = config('base.medical_certificate_types');
        $array = array();
        $i = 0;
        foreach ($type as $key => $value) {
            $array[$i]['value'] = $value;
            $array[$i]['key'] = $key;
            $i++;
        }
        $type = $array;
        
        $retailerProd = DB::table('ad_retailer_products')
                ->join('ad_company_products','ad_retailer_products.ad_company_product_id','=','ad_company_products.id')
                ->join('ad_products','ad_company_products.ad_product_id','=','ad_products.id')
                ->select('ad_retailer_products.*','ad_products.name as name_product')
                ->get();
        
        return view('admin.mcCertificates.new', compact('nav', 'action', 'main_menu', 'type', 'retailerProd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $mcQuestions = DB::table('mc_certificates')->insert(
                [
                    'ad_retailer_product_id' => $request->get('ad_retailer_product_id'),
                    'type' => $request->get('type'),
                    'name' => $request->get('name'),
                    'active' => $request->get('active')
                ]
        );
        return redirect()->route('mcCertificatesList')->with('new', 'message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }
    
    /**
     * lista de cuestionarios para asignacion.
     *
     * @param  int  $id_cert
     * @return \Illuminate\Http\Response
     */
    public function asignQuestionList($id_cert) {
        
        $nav = $this->nav;
        $action = 'asign';
        $main_menu = $this->menu_principal();
        $mcCertificateQuestionnaires = DB::table('mc_certificate_questionnaires')
                ->join('mc_questionnaires','mc_certificate_questionnaires.mc_questionnaire_id','=','mc_questionnaires.id')
                ->where('mc_certificate_questionnaires.mc_certificate_id',$id_cert)
                ->select('mc_certificate_questionnaires.*','mc_questionnaires.title as title_cuestionnaire')
                ->get();
        
        $inQuestion = DB::table('mc_certificate_questionnaire_questions')->groupBy('mc_certificate_questionnaire_id')->get();
        $var = array();
        foreach ($inQuestion as $key => $value) {
            $var[]=$value->mc_certificate_questionnaire_id;  
        }
        foreach ($mcCertificateQuestionnaires as $key => $value) {
            if(in_array($value->id, $var))
                    $mcCertificateQuestionnaires[$key]->asign = 1;
                    else
                    $mcCertificateQuestionnaires[$key]->asign = 0;
        }
        $mcCertificates = DB::table('mc_certificates')->where('id', $id_cert)->get();
        $mcCertificates = $mcCertificates[0];

        return view('admin.mcCertificates.asignQuestionList', compact('nav', 'action', 'main_menu', 'mcCertificateQuestionnaires', 'mcCertificates'));
    }
    /**
     * Formualario de asignacion de preguras nuevo.
     *
     * @param  int  $id_questionnaire
     * @param  int  $id_cert
     * @param  int  $id_cert_quest
     * @return \Illuminate\Http\Response
     */
    public function asignQuestionNewForm($id_questionnaire, $id_cert, $id_cert_quest) {
        
        $nav = $this->nav;
        $action = 'asign';
        $main_menu = $this->menu_principal();
        $mcQuestionnaires = DB::table('mc_questionnaires')->where('id',$id_questionnaire)->get();
        $mcQuestionnaires = $mcQuestionnaires[0];
        
        $mcQuestions = DB::table('mc_questions')->get();
        
        return view('admin.mcCertificates.asignQuestionNew', compact('nav', 'action', 'main_menu', 'mcQuestionnaires', 'mcQuestions', 'id_cert', 'id_cert_quest'));
    }
      
    /**
     * registrta asignacion de preguntas a cuestinoarios.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function asignQuestionStore(Request $request) {
        if  (count($request->get('mc_question_id')) > 0) {
            foreach ($request->get('mc_question_id') as $key => $value) {
                $store = DB::table('mc_certificate_questionnaire_questions')->insert(
                        [
                            'mc_question_id' => $value,
                            'mc_certificate_questionnaire_id' => $request->get('mc_certificate_questionnaire_id'),
                            'active' => $request->get('active')
                        ]
                );
            }
        }
        return redirect()->route('asignQuestionList',['id_cert'=>$request->get('id_certificado')])->with('new', 'message');
    }
    
    /**
     * Formualario de asignacion de preguras edicion.
     *
     * @param  int  $id_questionnaire
     * @param  int  $id_cert
     * @param  int  $id_cert_quest
     * @return \Illuminate\Http\Response
     */
    public function asignQuestionEditForm($id_questionnaire, $id_cert, $id_cert_quest) {
        
        $nav = $this->nav;
        $action = 'asign';
        $main_menu = $this->menu_principal();
        $mcQuestionnaires = DB::table('mc_questionnaires')->where('id',$id_questionnaire)->get();
        $mcQuestionnaires = $mcQuestionnaires[0];

        $qq = DB::table('mc_certificate_questionnaire_questions')->where('mc_certificate_questionnaire_id', $id_cert_quest)->get();
        
        $questionSlect = array();
        $selectActive = 0;
        foreach ($qq as $key => $value) {
            $questionSlect[$key]=$value->mc_question_id;
            $selectActive=$value->active;
        }
        
        $mcQuestions = DB::table('mc_questions')->get();
        
        foreach ($mcQuestions as $key => $value) {
            if (in_array($value->id, $questionSlect))
                $mcQuestions[$key]->selected = 1;
            else
                $mcQuestions[$key]->selected = 0;
        }
        
        
        
        return view('admin.mcCertificates.asignQuestionEdit', compact('nav', 'action', 'main_menu', 'mcQuestionnaires', 'mcQuestions', 'id_cert', 'id_cert_quest', 'selectActive'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function asignQuestionUpdate(Request $request) {
        
        if (count($request->get('mc_question_id')) > 0) {
            \Sibas\Entities\McCertificateQuestionnaireQuestions::where('mc_certificate_questionnaire_id', $request->get('mc_certificate_questionnaire_id'))->delete();
            foreach ($request->get('mc_question_id') as $key => $value) {
                $store = DB::table('mc_certificate_questionnaire_questions')->insert(
                        [
                            'mc_question_id' => $value,
                            'mc_certificate_questionnaire_id' => $request->get('mc_certificate_questionnaire_id'),
                            'active' => $request->get('active')
                        ]
                );
            }
        }

        return redirect()->route('asignQuestionList',['id_cert'=>$request->get('id_certificado')])->with('edit', 'message');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function asignQuestionnariesForm($id) {
        $nav = $this->nav;
        $action = 'asign';
        $main_menu = $this->menu_principal();
        $mcQuestionnaires = DB::table('mc_questionnaires')->get();
        
        $mcCertificates = DB::table('mc_certificates')->where('id', $id)->get();
        $mcCertificates = $mcCertificates[0];

        return view('admin.mcCertificates.asignQuestionnairesNew', compact('nav', 'action', 'main_menu', 'mcQuestionnaires', 'mcCertificates'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function asignQuestionnariesFormEdit($id) {
        
        $nav = $this->nav;
        $action = 'asign';
        $main_menu = $this->menu_principal();
        $mcQuestionnaires = DB::table('mc_questionnaires')->get();
        
        $mcCertificateQuestionnaires = DB::table('mc_certificate_questionnaires')->where('mc_certificate_id', $id)->get();
        
        # carga ids de mc_questionnaire
        $idsQ = array();
        foreach ($mcCertificateQuestionnaires as $key => $value) {
            $idsQ[] = $value->mc_questionnaire_id;
        }
        
        # valida questionarios seleccionados para este certificado
        foreach ($mcQuestionnaires as $key => $value) {
            if (in_array($value->id, $idsQ))
                $mcQuestionnaires[$key]->selected = 1;
            else
                $mcQuestionnaires[$key]->selected = 0;
        }

        $mcCertificates = DB::table('mc_certificates')->where('id', $id)->get();
        $mcCertificates = $mcCertificates[0];

        return view('admin.mcCertificates.asignQuestionnairesEdit', compact('nav', 'action', 'main_menu', 'mcQuestionnaires', 'mcCertificates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function asignQuestionnairesStore(Request $request) {
        if (count($request->get('mc_questionnaire_id')) > 0) {
            foreach ($request->get('mc_questionnaire_id') as $key => $value) {
                $mcCertificateQuestionnaires = DB::table('mc_certificate_questionnaires')->insert(
                        [
                            'mc_certificate_id' => $request->get('mc_certificate_id'),
                            'mc_questionnaire_id' => $value,
                            'active' => $request->get('active')
                        ]
                );
            }
        }

        return redirect()->route('mcCertificatesList')->with('new', 'message');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function asignQuestionnairesUpdate(Request $request) {
        
        if (count($request->get('mc_questionnaire_id')) > 0) {
            $mcCertQuest = DB::table('mc_certificate_questionnaires')->where('mc_certificate_id', $request->get('mc_certificate_id'))->get();
            # validacion elimina relacion de preguntas asignadas a questionario
            foreach ($mcCertQuest as $key => $value) {
                \Sibas\Entities\McCertificateQuestionnaireQuestions::where('mc_certificate_questionnaire_id', $value->id)->delete();
            }
            # validacion elimina relacion de questionario asignado a certificado
            \Sibas\Entities\McCertificateQuestionnaires::where('mc_certificate_id', $request->get('mc_certificate_id'))->delete();
            foreach ($request->get('mc_questionnaire_id') as $key => $value) {
                $mcCertificateQuestionnaires = DB::table('mc_certificate_questionnaires')->insert(
                        [
                            'mc_certificate_id' => $request->get('mc_certificate_id'),
                            'mc_questionnaire_id' => $value,
                            'active' => $request->get('active')
                        ]
                );
            }
        }

        return redirect()->route('mcCertificatesList')->with('new', 'message');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $nav = $this->nav;
        $action = 'edit';
        $main_menu = $this->menu_principal();

        $type = config('base.medical_certificate_types');
        $array = array();
        $i = 0;
        foreach ($type as $key => $value) {
            $array[$i]['value'] = $value;
            $array[$i]['key'] = $key;
            $i++;
        }
        $type = $array;
        $retailerProd = DB::table('ad_retailer_products')
                ->join('ad_company_products','ad_retailer_products.ad_company_product_id','=','ad_company_products.id')
                ->join('ad_products','ad_company_products.ad_product_id','=','ad_products.id')
                ->select('ad_retailer_products.*','ad_products.name as name_product')
                ->get();

        $entity = DB::table('mc_certificates')->where('id', $id)->get();
        $entity = $entity[0];

        return view('admin.mcCertificates.edit', compact('nav', 'action', 'entity', 'main_menu', 'id', 'type', 'retailerProd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $query_update = \Sibas\Entities\McCertificates::where('id', $id)->first();
        $query_update->ad_retailer_product_id = $request->input('ad_retailer_product_id');
        $query_update->type = $request->input('type');
        $query_update->name = $request->input('name');
        $query_update->active = $request->input('active');
        $query_update->save();

        return redirect()->route('mcCertificatesList')->with('edit', 'message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $mcCertQuest = DB::table('mc_certificate_questionnaires')->where('mc_certificate_id', $id)->get();
            # validacion elimina relacion de preguntas asignadas a questionario
            foreach ($mcCertQuest as $key => $value) {
                \Sibas\Entities\McCertificateQuestionnaireQuestions::where('mc_certificate_questionnaire_id', $value->id)->delete();
            }
        # validacion elimina relacion de questionario asignado a certificado
        \Sibas\Entities\McCertificateQuestionnaires::where('mc_certificate_id', $id)->delete();
        
        # validacion elimina certificado
        \Sibas\Entities\McCertificates::where('id', $id)->delete();
        return redirect()->route('mcCertificatesList')->with('delete', 'message');
    }

}
