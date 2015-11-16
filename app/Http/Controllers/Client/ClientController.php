<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
use Sibas\Http\Controllers\BaseController;
use Sibas\Http\Controllers\De\DetailDeController;
use Sibas\Http\Controllers\De\HeaderDeController;
use Sibas\Http\Controllers\Retailer\CityController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Client\ClientCreateFormRequest;
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
     * Display a listing of the resource.
     *
     * @param String $rp_id
     * @param String $header_id
     * @return \Illuminate\Http\Response
     */
    public function index($rp_id, $header_id)
    {
        return view('client.de.list', compact('rp_id', 'header_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param String $rp_id
     * @param String $header_id
     * @return \Illuminate\Http\Response
     */
    public function create($rp_id, $header_id)
    {
        $data = [
            'civil_status'  => $this->data->getCivilStatus(),
            'document_type' => $this->data->getDocumentType(),
            'gender'        => $this->data->getGender(),
            'cities'        => $this->cities->cityByType(),
            'activities'    => $this->activities->activities(),
        ];

        return view('client.de.create', compact('rp_id', 'header_id', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientCreateFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientCreateFormRequest $request)
    {
        $header = $this->header->headerTypeById($request->get('header_id'));
        $request['header'] = $header;

        if ($this->repository->saveClient($request)) {
            $request['client'] = $this->repository->getClient();

            if ($this->detail->store($request)) {
                return redirect()
                    ->route('de.question.create', [
                        'rp_id' => decrypt($request->get('rp_id')),
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
