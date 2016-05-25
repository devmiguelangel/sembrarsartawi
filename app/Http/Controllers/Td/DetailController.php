<?php

namespace Sibas\Http\Controllers\Td;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

use Sibas\Repositories\Td\DetailRepository;
use Sibas\Repositories\Td\FacultativeRepository;
use Sibas\Repositories\Td\HeaderRepository;

use Sibas\Repositories\De\DataRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;

class DetailController extends Controller
{

    /**
     * @var DetailRepository
     */
    protected $repository;

    /**
     * @var HeaderRepository
     */
    protected $headerRepository;

    /**
     * @var VehicleTypeRepository
     */
    protected $vehicleTypeRepository;

    /**
     * @var DataRepository
     */
    protected $dataRepository;

    /**
     * @var RetailerProductRepository
     */
    protected $retailerProductRepository;

    /**
     * @var VehicleMakeRepository
     */
    protected $vehicleMakeRepository;

    /**
     * @var FacultativeRepository
     */
    protected $facultativeRepository;


    public function __construct(
        DetailRepository $repository,
        HeaderRepository $headerRepository,
        FacultativeRepository $facultativeRepository,
        RetailerProductRepository $retailerProductRepository,
        DataRepository $dataRepository
    ) {
        $this->repository                = $repository;
        $this->headerRepository          = $headerRepository;
        $this->dataRepository            = $dataRepository;
        $this->retailerProductRepository = $retailerProductRepository;
        $this->facultativeRepository     = $facultativeRepository;
    }


    private function getData()
    {
       
    }


    /**
     * Lists Detail vehicle
     *
     * @param $rp_id
     * @param $header_id
     *
     * @return mixed
     */
    public function lists($rp_id, $header_id)
    {
        if ($this->headerRepository->getHeaderById(decode($header_id)) && $this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
            $header          = $this->headerRepository->getModel();
            $retailerProduct = $this->retailerProductRepository->getModel();

            return view('td.lists', compact('rp_id', 'header_id', 'header', 'retailerProduct'));
        }

        return redirect()->back();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param $rp_id
     * @param $header_id
     *
     * @return mixed
     */
    public function create($rp_id, $header_id)
    {
        
        return redirect()->back();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param VehicleCreateFormRequest $request
     * @param string                   $rp_id
     * @param string                   $header_id
     *
     * @return mixed
     */
    public function store(VehicleCreateFormRequest $request, $rp_id, $header_id)
    {
       

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param string $rp_id
     * @param string $header_id
     * @param string $detail_id
     *
     * @return mixed
     */
    public function destroy($rp_id, $header_id, $detail_id)
    {
        

        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param string $rp_id
     * @param string $header_id
     * @param string $detail_id
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function edit($rp_id, $header_id, $detail_id)
    {
        

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param VehicleCreateFormRequest $request
     * @param string                   $rp_id
     * @param string                   $header_id
     * @param string                   $detail_id
     */
    public function update(VehicleCreateFormRequest $request, $rp_id, $header_id, $detail_id)
    {
        

        return redirect()->back();
    }


    /**
     * @param string $rp_id
     * @param string $header_id
     * @param string $detail_id
     */
    public function editIssuance($rp_id, $header_id, $detail_id)
    {
        

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param VehicleEditFormRequest $request
     * @param string                 $rp_id
     * @param string                 $header_id
     * @param string                 $detail_id
     *
     * @return
     */
    public function updateIssuance(VehicleEditFormRequest $request, $rp_id, $header_id, $detail_id)
    {
        return redirect()->back();
    }

}
