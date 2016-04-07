<?php

namespace Sibas\Http\Controllers\Au;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Au\VehicleCreateFormRequest;
use Sibas\Http\Requests\Au\VehicleEditFormRequest;
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

            return view('au.lists', compact('rp_id', 'header_id', 'header', 'retailerProduct'));
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
        if (request()->ajax()) {
            if ($this->headerRepository->getHeaderById(decode($header_id)) && $this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
                $header          = $this->headerRepository->getModel();
                $retailerProduct = $this->retailerProductRepository->getModel();
                $parameter       = $retailerProduct->parameters()->where('slug', 'GE')->first();
                $categories      = $retailerProduct->categories()->where('active', true)->orderBy('category',
                    'ASC')->get();

                $data = $this->getData();

                $payload = view('au.vehicle-create', compact('rp_id', 'header_id', 'header', 'data', 'parameter'));

                return response()->json([
                    'payload'    => $payload->render(),
                    'types'      => $data['vehicle_types'],
                    'makes'      => $data['vehicle_makes'],
                    'categories' => $categories,
                ]);
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

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
        if (request()->ajax()) {
            if ($this->repository->getDetailById(decode($detail_id)) && $this->repository->removeVehicle()) {
                return response()->json([
                    'location' => route('au.vh.lists', [ 'rp_id' => $rp_id, 'header_id' => $header_id ])
                ]);
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

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
        if (request()->ajax()) {
            if ($this->repository->getDetailById(decode($detail_id)) && $this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
                $detail          = $this->repository->getModel();
                $header          = $detail->header;
                $retailerProduct = $this->retailerProductRepository->getModel();
                $parameter       = $retailerProduct->parameters()->where('slug', 'GE')->first();
                $categories      = $retailerProduct->categories()->where('active', true)->orderBy('category',
                    'ASC')->get();

                $data = $this->getData();

                $payload = view('au.vehicle-edit',
                    compact('rp_id', 'header_id', 'detail_id', 'header', 'data', 'parameter'));

                return response()->json([
                    'payload'    => $payload->render(),
                    'detail'     => $detail,
                    'types'      => $data['vehicle_types'],
                    'makes'      => $data['vehicle_makes'],
                    'categories' => $categories,
                    'year_max'   => date('Y') - $parameter->old_car,
                ]);
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

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
        if (request()->ajax()) {
            if ($this->repository->getDetailById(decode($detail_id))) {
                if ($this->repository->updateVehicle($request)) {
                    return response()->json([
                        'location' => route('au.vh.lists', [ 'rp_id' => $rp_id, 'header_id' => $header_id ])
                    ]);
                }
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

        return redirect()->back();
    }


    /**
     * @param string $rp_id
     * @param string $header_id
     * @param string $detail_id
     */
    public function editIssuance($rp_id, $header_id, $detail_id)
    {
        if (request()->ajax()) {
            if ($this->repository->getDetailById(decode($detail_id)) && $this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
                $detail          = $this->repository->getModel();
                $header          = $detail->header;
                $retailerProduct = $this->retailerProductRepository->getModel();
                $parameter       = $retailerProduct->parameters()->where('slug', 'GE')->first();
                $categories      = $retailerProduct->categories()->where('active', true)->orderBy('category',
                    'ASC')->get();

                $data = $this->getData();

                $payload = view('au.vehicle-edit-issuance',
                    compact('rp_id', 'header_id', 'detail_id', 'header', 'data', 'parameter'));

                return response()->json([
                    'payload'    => $payload->render(),
                    'detail'     => $detail,
                    'types'      => $data['vehicle_types'],
                    'makes'      => $data['vehicle_makes'],
                    'categories' => $categories,
                    'year_max'   => date('Y') - $parameter->old_car,
                ]);
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

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
        if (request()->ajax()) {
            if ($this->repository->getDetailById(decode($detail_id)) && $this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
                $retailerProduct = $this->retailerProductRepository->getModel();

                if ($this->repository->updateVehicleIssuance($request, $retailerProduct)) {
                    return response()->json([
                        'location' => route('au.edit', [ 'rp_id' => $rp_id, 'header_id' => $header_id ])
                    ]);
                }
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

        return redirect()->back();
    }

}
