<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
use Sibas\Http\Controllers\De\DetailController;
use Sibas\Http\Controllers\Retailer\RetailerProductController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Client\QuestionFormRequest;
use Sibas\Repositories\Client\QuestionRepository;
use Sibas\Repositories\De\DetailRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;

class QuestionController extends Controller
{
    /**
     * @var QuestionRepository
     */
    private $repository;
    /**
     * @var RetailerProductController
     */
    private $retailerProduct;
    /**
     * @var DetailController
     */
    private $detail;

    public function __construct(QuestionRepository $repository)
    {
        $this->repository      = $repository;
        $this->detail          = new DetailController(new DetailRepository);
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
     * @param String $detail_id
     * @return \Illuminate\Http\Response
     */
    public function create($rp_id, $header_id, $detail_id)
    {
        if ($this->detail->detailById(decode($detail_id))) {
            $detail = $this->detail->getDetail();

            $data = [
                'detail'      => $detail,
                'questions'   => $this->retailerProduct->questionByProduct($rp_id),
                'observation' => ''
            ];

            return view('client.de.question-create', compact('rp_id', 'header_id', 'detail_id', 'data'));
        }

        return redirect()->back()->with(['err_client' => 'El cliente no existe']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeDe(QuestionFormRequest $request)
    {
        if ($this->detail->detailById(decode($request->get('detail_id')))) {
            $detail            = $this->detail->getDetail();
            $request['detail'] = $detail;

            if ($this->repository->storeQuestionDe($request)) {
                return redirect()->route('de.client.list', [
                        'rp_id'     => decrypt($request->get('rp_id')),
                        'header_id' => $request->get('header_id'),
                    ]);
            }
        }

        return redirect()->back()->with(['err_question' => 'El Cuestionario de Salud no pudo ser registrado'])
            ->withInput()->withErrors($this->repository->getErrors());
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
     * @param $rp_id
     * @param $header_id
     * @param $detail_id
     * @return \Illuminate\Http\Response
     */
    public function edit($rp_id, $header_id, $detail_id)
    {
        if ($this->detail->detailById(decode($detail_id))) {
            $detail = $this->detail->getDetail();

            $data = [
                'detail'      => $detail,
                'questions'   => $this->repository->getQuestionsByResponse($detail->response->response),
                'observation' => $detail->response->observation
            ];

            return view('client.de.question-edit', compact('rp_id', 'header_id', 'detail_id', 'data'));
        }

        return redirect()->back();
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  QuestionFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateDe(QuestionFormRequest $request)
    {
        if ($this->detail->detailById(decode($request->get('detail_id')))) {
            $detail            = $this->detail->getDetail();
            $request['detail'] = $detail;

            if ($this->repository->updateQuestionDe($request)) {
                return redirect()->route('de.client.list', [
                    'rp_id'     => decrypt($request->get('rp_id')),
                    'header_id' => $request->get('header_id'),
                ]);
            }
        }

        return redirect()->back()
            ->with(['err_question' => 'El Cuestionario de Salud no pudo ser actualizado'])
            ->withInput()->withErrors($this->repository->getErrors());
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
