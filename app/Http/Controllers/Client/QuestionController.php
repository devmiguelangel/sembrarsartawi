<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
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
    protected $repository;

    /**
     * @var DetailRepository
     */
    protected $detailRepository;

    /**
     * @var RetailerProductRepository
     */
    protected $retailerProductRepository;


    public function __construct(
        QuestionRepository $repository,
        DetailRepository $detailRepository,
        RetailerProductRepository $retailerProductRepository
    ) {
        $this->repository                = $repository;
        $this->detailRepository          = $detailRepository;
        $this->retailerProductRepository = $retailerProductRepository;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param String $rp_id
     * @param String $header_id
     * @param String $detail_id
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rp_id, $header_id, $detail_id)
    {
        if ($this->detailRepository->getDetailById(decode($detail_id))) {
            $detail = $this->detailRepository->getModel();

            $data = [
                'detail'      => $detail,
                'questions'   => $this->retailerProductRepository->getQuestionByProduct(decode($rp_id),
                    $detail->header),
                'observation' => ''
            ];

            return view('client.de.question-create', compact('rp_id', 'header_id', 'detail_id', 'data'));
        }

        return redirect()->route('de.client.list', [
            'rp_id'     => $rp_id,
            'header_id' => $header_id
        ])->with([ 'error_detail' => 'Ha ocurrido un error en el Cuestionario de Salud' ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionFormRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function storeDe(QuestionFormRequest $request, $rp_id, $header_id, $detail_id)
    {
        if ($this->detailRepository->getDetailById(decode($detail_id))) {
            $request['detail'] = $this->detailRepository->getModel();

            if ($this->repository->storeQuestionDe($request)) {
                return redirect()->route('de.client.list', [
                    'rp_id'     => $rp_id,
                    'header_id' => $header_id,
                ])->with([
                    'success_question' => 'La información y el ' . 'cuestionario de salud del Cliente fueron registrados'
                ]);
            }
        }

        return redirect()->back()->with([ 'error_question' => 'El Cuestionario de Salud no pudo ser registrado' ])->withInput()->withErrors($this->repository->getErrors());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $rp_id
     * @param $header_id
     * @param $detail_id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($rp_id, $header_id, $detail_id)
    {
        if ($this->detailRepository->getDetailById(decode($detail_id))) {
            $detail = $this->detailRepository->getModel();

            $data = [
                'detail'      => $detail,
                'questions'   => $this->repository->getQuestionsByResponse($detail->response->response),
                'observation' => $detail->response->observation
            ];

            return view('client.de.question-edit', compact('rp_id', 'header_id', 'detail_id', 'data'));
        }

        return redirect()->back()->with([ 'error_question' => 'El Cuestionario de Salud no puede ser editado' ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  QuestionFormRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateDe(QuestionFormRequest $request, $rp_id, $header_id, $detail_id)
    {
        if ($this->detailRepository->getDetailById(decode($detail_id))) {
            $request['detail'] = $this->detailRepository->getModel();

            if ($this->repository->updateQuestionDe($request)) {
                return redirect()->route('de.client.list', [
                    'rp_id'     => $rp_id,
                    'header_id' => $header_id,
                ])->with([ 'success_question' => 'El Cuestionario de Salud se actualizó correctamente' ]);
            }
        }

        return redirect()->back()->with([ 'error_question' => 'El Cuestionario de Salud no pudo ser actualizado' ])->withInput()->withErrors($this->repository->getErrors());
    }

}
