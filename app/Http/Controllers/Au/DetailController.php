<?php

namespace Sibas\Http\Controllers\Au;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Au\VehicleCreateFormRequest;
use Sibas\Repositories\Au\DetailRepository;
use Sibas\Repositories\Au\HeaderRepository;
use Sibas\Repositories\Au\VehicleMakeRepository;
use Sibas\Repositories\Au\VehicleTypeRepository;
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


    public function __construct(
        DetailRepository $repository,
        HeaderRepository $headerRepository,
        RetailerProductRepository $retailerProductRepository,
        VehicleTypeRepository $vehicleTypeRepository,
        VehicleMakeRepository $vehicleMakeRepository,
        DataRepository $dataRepository
    ) {
        $this->repository                = $repository;
        $this->headerRepository          = $headerRepository;
        $this->vehicleTypeRepository     = $vehicleTypeRepository;
        $this->vehicleMakeRepository     = $vehicleMakeRepository;
        $this->dataRepository            = $dataRepository;
        $this->retailerProductRepository = $retailerProductRepository;
    }


    private function getData()
    {
        return [
            'vehicle_types'      => $this->vehicleTypeRepository->getVehicleType(),
            'vehicle_categories' => $this->dataRepository->getVehicleCategory(),
            'vehicle_uses'       => $this->dataRepository->getVehicleUse(),
            'vehicle_makes'      => $this->vehicleMakeRepository->getVehicleMakes(),
        ];
    }


    public function lists($rp_id, $header_id)
    {
        if ($this->headerRepository->getHeaderById(decode($header_id)) && $this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
            $header          = $this->headerRepository->getModel();
            $retailerProduct = $this->retailerProductRepository->getModel();

            return view('au.lists', compact('rp_id', 'header_id', 'header', 'retailerProduct'));
        }

        return redirect()->back();
    }


    public function create($rp_id, $header_id)
    {
        if (request()->ajax()) {
            if ($this->headerRepository->getHeaderById(decode($header_id)) && $this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
                $header          = $this->headerRepository->getModel();
                $retailerProduct = $this->retailerProductRepository->getModel();
                $categories      = $retailerProduct->categories()->where('active', true)->orderBy('category',
                    'ASC')->get();

                $data = $this->getData();

                $payload = view('au.vehicle-create',
                    compact('rp_id', 'header_id', 'header', 'data', 'retailerProduct'));

                return response()->json([
                    'payload'    => $payload->render(),
                    'types'      => $data['vehicle_types'],
                    'makes'      => $data['vehicle_makes'],
                    'categories' => $categories,
                ]);
            }

        }

        return redirect()->back();
    }


    public function store(VehicleCreateFormRequest $request, $rp_id, $header_id)
    {
        if (request()->ajax()) {
            if ($this->headerRepository->getHeaderById(decode($header_id))) {
                $header = $this->headerRepository->getModel();

                if ($this->repository->storeVehicle($request, $header)) {
                    return response()->json([
                        'location' => route('au.vh.lists', [ 'rp_id' => $rp_id, 'header_id' => $header_id ])
                    ]);
                }
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

        return redirect()->back();
    }
}
