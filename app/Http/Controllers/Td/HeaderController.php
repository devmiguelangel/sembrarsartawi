<?php

namespace Sibas\Http\Controllers\Td;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Sibas\Entities\Client;
use Sibas\Entities\City;
use Sibas\Entities\Rate;
use Sibas\Entities\Td\Detail;
use Sibas\Http\Controllers\DataTrait;
use Sibas\Http\Controllers\MailController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Td\ClientComplementFormRequest;
use Sibas\Http\Requests\Td\FacultativeRequestFormRequest;
use Sibas\Http\Requests\Td\HeaderCreateFormRequest;
use Sibas\Http\Requests\Td\HeaderEditFormRequest;
use Sibas\Repositories\Td\FacultativeRepository;
use Sibas\Repositories\Td\HeaderRepository;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\Td\DetailRepository;
use Sibas\Repositories\Retailer\PolicyRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;


class HeaderController extends Controller {

    /**
     * @var ClientRepository
     */
    protected $detailRepository;
    
    /**
     * @var ClientRepository
     */
    protected $clientRepository;

    /**
     * @var HeaderRepository
     */
    protected $repository;

    /**
     * @var RetailerProductRepository
     */
    protected $retailerProductRepository;

    /**
     * @var PolicyRepository
     */
    protected $policyRepository;

    /**
     * @var FacultativeRepository
     */
    protected $facultativeRepository;

    public function __construct(
    HeaderRepository $repository, ClientRepository $clientRepository, DetailRepository $detailRepository, FacultativeRepository $facultativeRepository, RetailerProductRepository $retailerProductRepository, PolicyRepository $policyRepository
    ) {
        $this->repository = $repository;
        $this->clientRepository = $clientRepository;
        $this->detailRepository = $detailRepository;
        $this->retailerProductRepository = $retailerProductRepository;
        $this->policyRepository = $policyRepository;
        $this->facultativeRepository = $facultativeRepository;
    }

use DataTrait;

    /**edw
     *
     * Show the form for creating a new resource.
     *
     * @param string $rp_id
     *
     * @return mixed
     */
    public function create($rp_id) {
        $client = new Client();
        if (session('client')) {
            $client = session('client');
        }
        $data = $this->getData($rp_id);
        $data['payment_methods'] = $this->retailerProductRepository->getPaymentMethodsByProductById(decode($rp_id));
        
        return view('td.create', compact('rp_id', 'data', 'client'));
    }
    
    /**edw
     * funcion registra cotizacion
     * @param type $rp_id
     * @param type $header_id
     * @return type
     */
    public function resultCot($rp_id, $header_id) {
        $detail = Detail::where('op_td_header_id', decode($header_id))->get();
        if (count($detail) === 0) {
            return redirect()->back()->with([ 'error_header' => 'Presione "Nuevo" para registrar Riesgos.']);
        } else {
            if ($this->repository->getHeaderById(decode($header_id)) && $this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
                $header = $this->repository->getModel();
                $retailerProduct = $this->retailerProductRepository->getModel();

                $rate = Rate::where('ad_retailer_product_id', decode($rp_id))->first();
                $totalPremium = 0;
                foreach ($detail as $key => $value) {
                    $this->detailRepository->updateRate($value->toArray(), $rate->rate_final);
                    $totalPremium+= ($value->insured_value * $rate->rate_final) / 100;
                }

                $this->repository->updateHeaderTotalPremium(decode($header_id), $totalPremium);

                return view('td.result', compact('rp_id', 'header_id', 'header', 'retailerProduct'));
            }
        }
        return redirect()->back()->with([ 'error_header' => 'No se posible calcular la prima.']);
    }

    /**edw
     *
     *  Store a newly created resource in storage.
     *
     * @param HeaderCreateFormRequest $request
     * @param string                  $rp_id
     *
     * @return mixed
     */
    public function store(HeaderCreateFormRequest $request, $rp_id) {
        if ($this->clientRepository->createClient($request)) {
            $client = $this->clientRepository->getModel();
            
            if ($this->repository->storeHeader($request, $client)) {
                $header = $this->repository->getModel();

                return redirect()->route('td.mr.insured', [
                            'rp_id' => $rp_id,
                            'header_id' => encode($header->id),
                        ])->with([ 'success_header' => 'La cotización fue registrada con éxito.']);
            }
        }

        return redirect()->back()->with([ 'error_header' => 'El Cliente no pudo ser registrado'])->withInput()->withErrors($this->repository->getErrors());
    }

   /**edw
     * Lists Detail vehicle
     *
     * @param $rp_id
     * @param $header_id
     *
     * @return mixed
     */
    public function insured($rp_id, $header_id) {
            return view('td.insured', compact('rp_id', 'header_id'));
    }
    
    /**edw
     * 
     * @param type $rp_id
     * @param type $header_id
     * @param type $id
     * @return type
     */
    public function formDetail($rp_id, $header_id, $id_detail) {
        $materia = $this->returnArray(config('base.property_types'));
        $uso = $this->returnArray(config('base.property_uses'));
        $city = City::where('abbreviation','!=','')->where('abbreviation','!=','PE')->get();
        if($id_detail != 0)
            $detail = Detail::where('id', $id_detail)->first();
        else
            $detail = new Detail();
        
        $arr = array(0=>array('id'=>0,'name'=>'Seleccione'));
        $i = 1;
        foreach ($city->toArray() as $key => $value) {
            $arr[$i] = $value;
            $i++;
        }
        $city = $arr;
        
        $var = array('template' => view('td.form.formInsured', compact('rp_id','header_id', 'materia', 'uso', 'city', 'detail'))->render());
        return response()->json($var);
    }
    /**edw
     * funcion guarda detalle ajax
     * @param \Illuminate\Http\Request $request
     * @return int
     */
    public function storeInsured(Request $request){
        $this->detailRepository->createDetail($request);
    }
    
    /**edw
     * funcion lista riesgos
     * @param type $rp_id
     * @param type $header_id
     * @return type
     */
    public function listInsured($rp_id, $header_id){
        $detail = Detail::where('op_td_header_id',decode($header_id))->get();
        $var = array('template' => view('td.listInsured', compact('detail','header_id', 'rp_id'))->render());
        return response()->json($var);
    }

    /**edw
     * retorna array 
     * @param type $array
     */
    public function returnArray($array) {
        $arr = [];
        $arr[0]['id'] = 0;
        $arr[0]['name'] = 'Seleccione';
        $i = 1;
        foreach ($array as $key => $value) {
            $arr[$i]['id'] = $key;
            $arr[$i]['name'] = $value;
            $i++;
        }
        return $arr;
    }

  

    /**edw
     * Show the form for editing the specified resource.
     *
     * @param $rp_id
     * @param $header_id
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function edit($rp_id, $header_id) {
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();
            $policies = $this->policyRepository->getPolicyByCurrency(decode($rp_id), $header->currency);
            
            $paymentMethods = config('base.payment_methods');
            $termTypes = config('base.term_types');
            
            return view('td.edit', compact('rp_id', 'header_id', 'header','paymentMethods', 'termTypes', 'policies'));
        }
        return redirect()->back();
    }

    /**edw
     * Update the specified resource in storage.
     *
     * @param HeaderEditFormRequest $request
     * @param string                $rp_id
     * @param string                $header_id
     */
    public function update(HeaderEditFormRequest $request, $rp_id, $header_id) {
        if ($this->repository->getHeaderById(decode($header_id))) {
            if ($this->repository->updateHeader($request)) {
                return redirect()->route('td.edit', [
                            'rp_id' => $rp_id,
                            'header_id' => $header_id,
                        ])->with([ 'success_header' => 'La Póliza fue actualizada con éxito.']);
            }
        }

        return redirect()->back()->withInput();
    }

    /**edw
     * @param string $rp_id
     * @param string $header_id
     * @param string $client_id
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function editClient($rp_id, $header_id, $client_id) {
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();
            $client = $header->client;

            if ($client instanceof Client && $client->id == decode($client_id)) {
                $data = $this->getData($rp_id);

                return view('client.td.edit-issuance', compact('rp_id', 'header_id', 'client_id', 'client', 'data'));
            }
        }

        return redirect()->back();
    }

    /**
     * @param ClientComplementFormRequest $request
     * @param string                      $rp_id
     * @param string                      $header_id
     * @param string                      $client_id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateClient(ClientComplementFormRequest $request, $rp_id, $header_id, $client_id) {
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();

            if (( $header->client instanceof Client && $header->client->id == decode($client_id) ) && $this->clientRepository->updateIssueClient($request, $header->client)
            ) {
                return redirect()->route('td.edit', [
                            'rp_id' => $rp_id,
                            'header_id' => $header_id,
                            $request->get('idf') ? 'idf=' . $request->get('idf') : null
                        ])->with([ 'success_client' => 'La información del Cliente se actualizó correctamente']);
            }
        }

        return redirect()->back()->with([ 'error_client' => 'La información del Cliente no pudo ser actualizada'])->withInput()->withErrors($this->repository->getErrors());
    }

    /**edw
     * Header show issuance
     */
    public function showIssuance($rp_id, $header_id) {
        $this->retailerProductRepository->getRetailerProductById(decode($rp_id));
        $rp = $this->retailerProductRepository->getModel();
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();

            if ($header->issued) {
                return view('td.issuance', compact('rp_id', 'header_id', 'header', 'rp'))->with([ 'success_header' => 'La Póliza fue emitida con éxito.']);
            }
        }

        return redirect()->back();
    }

    /**
     * Header update issuance
     *
     * @param string $rp_id
     * @param string $header_id
     *
     * @return
     */
    public function updateIssuance($rp_id, $header_id) {
        if ($this->repository->getHeaderById(decode($header_id))) {
            if ($this->repository->issuanceHeader()) {
                return redirect()->route('td.show.issuance', [
                            'rp_id' => $rp_id,
                            'header_id' => $header_id,
                        ])->with([ 'success_header' => 'La Póliza fue emitida con éxito.']);
            }
        }

        return redirect()->back();
    }





}
