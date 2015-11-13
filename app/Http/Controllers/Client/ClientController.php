<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
use Sibas\Http\Controllers\BaseController;
use Sibas\Http\Controllers\Retailer\CityController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Client\ClientCreateFormRequest;
use Sibas\Repositories\Client\ActivityRepository;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\De\DataRepository;
use Sibas\Repositories\Retailer\CityRepository;

class ClientController extends Controller
{
    private $data;
    /**
     * @var ClientRepository
     */
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->data       = new BaseController(new DataRepository);
        $this->cities     = new CityController(new CityRepository);
        $this->activities = new ActivityController(new ActivityRepository);
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($header_id)
    {
        return view('client.de.list', ['header_id' => $header_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($header_id)
    {
        $data = [
            'civil_status'  => $this->data->getCivilStatus(),
            'document_type' => $this->data->getDocumentType(),
            'gender'        => $this->data->getGender(),
            'cities'        => $this->cities->cityByType(),
            'activities'    => $this->activities->activities(),
        ];

        return view('client.de.create', compact('header_id', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientCreateFormRequest $request)
    {
        $this->repository->saveClientQuote($request);
        dd($request->all());
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
