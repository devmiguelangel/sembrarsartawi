<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Sibas\Entities\Client;
use Sibas\Http\Controllers\BaseController;
use Sibas\Http\Controllers\De\DetailDeController;
use Sibas\Http\Controllers\De\HeaderController;
use Sibas\Http\Controllers\Retailer\CityController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Client\ClientCreateFormRequest;
use Sibas\Http\Requests\Client\ClientStoreFormRequest;
use Sibas\Repositories\Client\ActivityRepository;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\De\DataRepository;
use Sibas\Repositories\De\DetailDeRepository;
use Sibas\Repositories\De\HeaderRepository;
use Sibas\Repositories\Retailer\CityRepository;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $repository;
    /**
     * @var HeaderController
     */
    private $header;
    /**
     * @var DetailDeController
     */
    private $detail;
    /**
     * @var CityController
     */
    private $cities;
    /**
     * @var ActivityController
     */
    private $activities;
    /**
     * @var BaseController
     */
    private $base;

    public function __construct(ClientRepository $repository)
    {
        $this->header     = new HeaderController(new HeaderRepository);
        $this->detail     = new DetailDeController(new DetailDeRepository);
        $this->base       = new BaseController(new DataRepository);
        $this->cities     = new CityController(new CityRepository);
        $this->activities = new ActivityController(new ActivityRepository);
        $this->repository = $repository;
    }

    /**
     * Return Client list of Header
     *
     * @param string $rp_id
     * @param string $header_id
     * @return View
     */
    public function lists($rp_id, $header_id)
    {
        if ($this->header->headerById(decode($header_id))) {
            $header = $this->header->getHeader();

            return view('client.de.list', compact('rp_id', 'header_id', 'header'));
        }

        return redirect()->back()->with(['list' => 'La cotizacion no existe']);
    }

    public function clientById($client_id)
    {
        return $this->repository->getClientById($client_id);
    }

    /**
     * Returns Data for Client register
     * @return array
     */
    private function getData()
    {
        return [
            'civil_status'  => $this->base->getCivilStatus(),
            'document_type' => $this->base->getDocumentType(),
            'gender'        => $this->base->getGender(),
            'cities'        => $this->cities->cityByType(),
            'activities'    => $this->activities->activities(),
            'hands'         => $this->base->getHand(),
            'avenue_street' => $this->base->getAvenueStreet(),
        ];
    }

    /**
     * Show the form for creating a new Client.
     *
     * @param string $rp_id
     * @param string $header_id
     * @return Response
     */
    public function create($rp_id, $header_id)
    {
        $data   = $this->getData();
        $client = new Client();

        return view('client.de.create', compact('rp_id', 'header_id', 'data', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientCreateFormRequest $request
     * @return Response
     */
    public function store(ClientCreateFormRequest $request)
    {
        if ($this->header->headerById(decode($request->get('header_id')))) {
            $header            = $this->header->getHeader();
            $request['header'] = $header;

            if ($this->repository->createClient($request)) {
                $request['client'] = $this->repository->getModel();

                if ($this->detail->store($request)) {
                    return redirect()
                        ->route('de.question.create', [
                            'rp_id'     => decrypt($request->get('rp_id')),
                            'header_id' => encode($header->id),
                            'client_id' => encode($this->repository->getId())
                        ]);
                }
            }
        }


        return redirect()->back()->withInput()->withErrors($this->repository->getErrors());
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
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
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
     * @return Response
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
     * @param  ClientCreateFormRequest $request
     * @param  int  $client_id
     * @return Response
     */
    public function update(ClientCreateFormRequest $request, $rp_id, $header_id, $client_id)
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
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
