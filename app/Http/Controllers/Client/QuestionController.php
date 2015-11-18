<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
use Sibas\Http\Controllers\De\HeaderController;
use Sibas\Http\Controllers\Retailer\RetailerProductController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Client\QuestionFormRequest;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\Client\QuestionRepository;
use Sibas\Repositories\De\HeaderRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;

class QuestionController extends Controller
{
    private $retailerProduct;
    /**
     * @var QuestionRepository
     */
    private $repository;

    private $client;

    public function __construct(QuestionRepository $repository)
    {
        $this->repository      = $repository;
        $this->header          = new HeaderController(new HeaderRepository);
        $this->client          = new ClientController(new ClientRepository);
        $this->retailerProduct = new RetailerProductController(new RetailerProductRepository);
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
     * @param String $client_id
     * @return \Illuminate\Http\Response
     */
    public function create($rp_id, $header_id, $client_id)
    {
        $client = null;

        if ($this->client->clientById(decode($client_id))) {
            $client = $this->client->getClient();
        }

        $data = [
            'client'    => $client,
            'questions' => $this->retailerProduct->questionByProduct($rp_id)
        ];

        return view('client.de.question', compact('rp_id', 'header_id', 'client_id', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeDe(QuestionFormRequest $request)
    {
        $header = $this->header->headerById($request->get('header_id'));
        $request['header'] = $header;

        if ($this->repository->saveQuestionDe($request)) {
            return redirect()
                ->route('de.client.list', [
                    'rp_id' => decrypt($request->get('rp_id')),
                    'header_id' => encode($header->id)
                ]);
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
