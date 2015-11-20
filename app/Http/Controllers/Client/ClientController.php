<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Sibas\Entities\Client;
use Sibas\Http\Controllers\BaseController;
use Sibas\Http\Controllers\De\HeaderController;
use Sibas\Http\Controllers\Retailer\CityController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\Client\ActivityRepository;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\De\DataRepository;
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
        $this->base       = new BaseController(new DataRepository);
        $this->cities     = new CityController(new CityRepository);
        $this->activities = new ActivityController(new ActivityRepository);
        $this->repository = $repository;
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

    /** Find Client by Id
     *
     * @param $client_id
     * @return bool
     */
    public function clientById($client_id)
    {
        return $this->repository->getClientById($client_id);
    }

    /**
     * Returns Data for Client register
     * @return array
     */
    public function getData()
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
     * @param $client_id
     * @return Response
     */
    public function create($rp_id, $header_id, $client_id = null)
    {
        $data   = $this->getData();
        $client = new Client();

        if (! is_null($client_id) && $this->repository->getClientById(decode($client_id))) {
            $client = $this->repository->getModel();
        }

        return view('client.de.create', compact('rp_id', 'header_id', 'data', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return bool
     */
    public function store(Request $request)
    {
        if ($this->repository->createClient($request)) {
            return true;
        }

        return false;
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

            $client    = $this->repository->getModel();
            $client_id = encode($client->id);

            return redirect()->route('de.detail.create', compact('rp_id', 'header_id', 'client_id'));
        }

        return redirect()->back()->with(['err_client' => 'El Cliente no existe'])
            ->withInput()->withErrors($this->repository->getErrors());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $rp_id
     * @param $header_id
     * @param $detail_id
     * @param $client
     * @return Response
     */
    public function edit($rp_id, $header_id, $detail_id, $client)
    {
        $data = $this->getData();

        return view('client.de.edit', compact('rp_id', 'header_id', 'detail_id', 'data', 'client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param $rp_id
     * @param $header_id
     * @param  Client $client
     * @return Response
     */
    public function update($request, $rp_id, $header_id, $client)
    {
        if ($this->repository->editClient($request, $client)) {
            return redirect()->route('de.client.list', [
                'rp_id'     => decrypt($request->get('rp_id')),
                'header_id' => $header_id
            ]);
        }

        return redirect()->back()->withInput()->withErrors($this->repository->getErrors());
    }

    public function updateIssue(Request $request)
    {
        return $this->repository->updateIssueClient($request);
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

    /**
     * Returns Client
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getClient()
    {
        return $this->repository->getModel();
    }

}
