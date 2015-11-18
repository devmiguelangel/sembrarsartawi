<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
use Sibas\Entities\Client;
use Sibas\Http\Controllers\BaseController;
use Sibas\Http\Controllers\De\DetailDeController;
use Sibas\Http\Controllers\De\HeaderDeController;
use Sibas\Http\Controllers\Retailer\CityController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Client\ClientQuoteFormRequest;
use Sibas\Http\Requests\Client\ClientStoreFormRequest;
use Sibas\Repositories\Client\ActivityRepository;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\De\DataRepository;
use Sibas\Repositories\De\DetailDeRepository;
use Sibas\Repositories\De\HeaderDeRepository;
use Sibas\Repositories\Retailer\CityRepository;

class ClientController extends Controller
{
    private $data;
    /**
     * @var ClientRepository
     */
    private $repository;

    private $header;

    private $detail;

    private $cities;

    private $activities;

    public function __construct(ClientRepository $repository)
    {
        $this->header     = new HeaderDeController(new HeaderDeRepository);
        $this->detail     = new DetailDeController(new DetailDeRepository);
        $this->data       = new BaseController(new DataRepository);
        $this->cities     = new CityController(new CityRepository);
        $this->activities = new ActivityController(new ActivityRepository);
        $this->repository = $repository;
    }

    public function getClient()
    {
        return $this->repository->getClient();
    }

    public function clientById($client_id)
    {
        return $this->repository->getClientById($client_id);
    }

    /**
     * Return Data for register Client
     * @return array
     */
    private function getData()
    {
        return [
            'civil_status'  => $this->data->getCivilStatus(),
            'document_type' => $this->data->getDocumentType(),
            'gender'        => $this->data->getGender(),
            'cities'        => $this->cities->cityByType(),
            'activities'    => $this->activities->activities(),
            'hands'         => $this->data->getHand(),
            'avenue_street' => $this->data->getAvenueStreet(),
        ];
    }

    /**
     * Return list to Header
     *
     * @param $rp_id
     * @param $header_id
     * @return \Illuminate\View\View
     */
    public function lists($rp_id, $header_id)
    {
        $header = $this->header->headerById($header_id);

        return view('client.de.list', compact('rp_id', 'header_id', 'header'));
    }

    /**
     * Return Client by search
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        if ($this->repository->getClientByDni($request->get('dni'))) {
            $rp_id     = decrypt($request->get('rp_id'));
            $header_id = $request->get('header_id');

            $client = $this->getClient();
            $client_id = encode($client->id);

            return redirect()->route('de.client.create', compact('rp_id', 'header_id', 'client_id'));
        }

        return redirect()->back()->withInput()->withErrors(['client-search' => 'El Cliente no existe']);
    }

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
     * @param String $rp_id
     * @param String $header_id
     * @param Client $client_id
     * @return \Illuminate\Http\Response
     */
    public function create($rp_id, $header_id, $client_id = null)
    {
        $data   = $this->getData();
        $client = new Client();

        if (! is_null($client_id)) {
            if ($this->repository->getClientById(decode($client_id))) {
                $client = $this->repository->getClient();
            }
        }

        return view('client.de.create', compact('rp_id', 'header_id', 'data', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientQuoteFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientQuoteFormRequest $request)
    {
        $header = $this->header->headerTypeById($request->get('header_id'));
        $request['header'] = $header;

        if ($this->repository->saveClient($request)) {
            $request['client'] = $this->repository->getClient();

            if ($this->detail->store($request)) {
                return redirect()
                    ->route('de.question.create', [
                        'rp_id'     => decrypt($request->get('rp_id')),
                        'header_id' => encode($header->id),
                        'client_id' => encode($this->repository->getId())
                    ]);
            }
        }

        return redirect()->back()->withInput()->withErrors($this->repository->getErrors());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $rp_id
     * @param $header_id
     * @param $client_id
     * @return \Illuminate\Http\Response
     */
    public function edit($rp_id, $header_id, $client_id)
    {
        $data   = $this->getData();
        $client = new Client();

        if ($this->repository->getClientById(decode($client_id))) {
            $client = $this->repository->getClient();
        }

        return view('client.de.edit', compact('rp_id', 'header_id', 'data', 'client'));
    }

    public function issueEdit($rp_id, $header_id, $client_id, $ref)
    {
        $ref = strtoupper($ref);

        if ($ref === 'ISE' || $ref === 'ISU') {
            $data   = $this->getData();
            $client = new Client();

            if ($this->repository->getClientById(decode($client_id))) {
                $client = $this->repository->getClient();
            }

            $header = $this->header->headerById($header_id);
            $detail = null;

            foreach ($header->details as $details) {
                if ($details->client->id === $client->id) {
                    $detail = $details;
                    break;
                }
            }

            if ($ref === 'ISE') {
                return view('client.de.i-create', compact('rp_id', 'header_id', 'data', 'client', 'detail', 'ref'));
            } elseif (strtoupper($ref) === 'ISU') {
                // return view('client.de.edit', compact('rp_id', 'header_id', 'data', 'client'));
            }

        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClientQuoteFormRequest $request
     * @param  int  $client_id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientQuoteFormRequest $request, $rp_id, $header_id, $client_id)
    {
        if ($this->repository->putClient($request, $client_id)) {
            return redirect()->route('de.client.list', [
                'rp_id'     => decrypt($request->get('rp_id')),
                'header_id' => $header_id
            ]);
        }

        return redirect()->back()->withInput()->withErrors($this->repository->getErrors());
    }

    public function issueStore(ClientStoreFormRequest $request, $rp_id, $header_id, $client_id)
    {
        $ref       = decrypt($request->get('ref'));
        $client_id = decode($client_id);

        if (strtoupper($ref) === 'ISE') {
            if ($this->repository->issueStoreClient($request, $client_id)) {
                return redirect()->route('de.edit', [
                    'rp_id'     => decrypt($request->get('rp_id')),
                    'header_id' => $header_id
                ]);
            }
        }

        return redirect()->back()->withInput()->withErrors($this->repository->getErrors());
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
