<?php

namespace Sibas\Http\Controllers\Td;

use Illuminate\Http\Request;

use Sibas\Http\Controllers\MailController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\De\FacultativeFormRequest;
use Sibas\Repositories\Td\FacultativeRepository;
use Sibas\Repositories\Td\HeaderRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;

class FacultativeController extends Controller
{

    /**
     * @var FacultativeRepository
     */
    protected $repository;

    /**
     * @var HeaderRepository
     */
    protected $headerRepository;

    /**
     * @var RetailerProductRepository
     */
    protected $retailerProductRepository;


    public function __construct(
        FacultativeRepository $repository,
        HeaderRepository $headerRepository,
        RetailerProductRepository $retailerProductRepository
    ) {
        $this->repository                = $repository;
        $this->headerRepository          = $headerRepository;
        $this->retailerProductRepository = $retailerProductRepository;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param string $rp_id
     * @param string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($rp_id, $id)
    {
       

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param FacultativeFormRequest $request
     * @param string                 $rp_id
     * @param string                 $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(FacultativeFormRequest $request, $rp_id, $id)
    {
        
        return redirect()->back();
    }


    /**
     * @param string $rp_id
     * @param string $id
     *
     * @return mixed
     */
    public function observation($rp_id, $id)
    {
        

        return redirect()->back();
    }


    /**
     * @param string $rp_id
     * @param string $id
     * @param string $id_observation
     *
     * @return mixed
     */
    public function createAnswer($rp_id, $id, $id_observation)
    {
       

        return redirect()->back();
    }


    /**
     * @param Request $request
     * @param string  $rp_id
     * @param string  $id
     * @param string  $id_observation
     *
     * @return mixed
     */
    public function storeAnswer(Request $request, $rp_id, $id, $id_observation)
    {
       
        return redirect()->back();
    }


    /**
     * @param string $rp_id
     * @param string $id
     * @param string $id_observation
     *
     * @return mixed
     */
    public function response($rp_id, $id, $id_observation)
    {
        

        return redirect()->back();
    }


    /**
     * @param string $rp_id
     * @param string $id
     *
     * @return mixed
     */
    public function observationProcess($rp_id, $id)
    {
        

        return redirect()->back();
    }


    /**
     * @param Request $request
     * @param string  $rp_id
     * @param string  $id
     *
     * @return mixed
     */
    public function readUpdate(Request $request, $rp_id, $id)
    {
       
        return redirect()->back();
    }

}
