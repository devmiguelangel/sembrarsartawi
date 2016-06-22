<?php

namespace Sibas\Http\Controllers\Td;

use Illuminate\Support\Facades\Cache;
use Sibas\Entities\Td\Detail;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Td\PropertyEditFormRequest;
use Sibas\Repositories\Retailer\CityRepository;
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
     * @var DataRepository
     */
    protected $dataRepository;

    /**
     * @var RetailerProductRepository
     */
    protected $retailerProductRepository;

    /**
     * @var FacultativeRepository
     */
    protected $facultativeRepository;

    /**
     * @var CityRepository
     */
    protected $cityRepository;


    public function __construct(
        DetailRepository $repository,
        HeaderRepository $headerRepository,
        FacultativeRepository $facultativeRepository,
        RetailerProductRepository $retailerProductRepository,
        CityRepository $cityRepository,
        DataRepository $dataRepository
    ) {
        $this->repository                = $repository;
        $this->headerRepository          = $headerRepository;
        $this->dataRepository            = $dataRepository;
        $this->retailerProductRepository = $retailerProductRepository;
        $this->facultativeRepository     = $facultativeRepository;
        $this->cityRepository            = $cityRepository;
    }


    private function getData()
    {
        return [
            'property_types' => $this->dataRepository->getPropertyTypes(),
            'property_uses'  => $this->dataRepository->getPropertyUses(),
            'cities'         => $this->cityRepository->getCitiesByType(),
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

            return view('td.lists', compact('rp_id', 'header_id', 'header', 'retailerProduct'));
        }

        return redirect()->back();
    }


    /**
     * @param string $rp_id
     * @param string $header_id
     * @param string $detail_id
     */
    public function editIssuance($rp_id, $header_id, $detail_id = null)
    {
        if (request()->ajax()) {
            $flag   = false;
            $header = null;
            $detail = null;

            if ($this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
                $retailerProduct = $this->retailerProductRepository->getModel();
                $parameter       = $retailerProduct->parameters()->where('slug', 'GE')->first();
                $exchange_rate   = $retailerProduct->retailer->exchangeRate;

                $data = $this->getData();

                if ($this->repository->getDetailById(decode($detail_id))) {
                    $detail = $this->repository->getModel();
                    $header = $detail->header;

                    $flag = true;
                } elseif (Cache::has(decode($header_id)) && request()->has('coverage') && $this->headerRepository->getHeaderById(decode($header_id))) {
                    $detail = new Detail();
                    $header = $this->headerRepository->getModel();

                    $flag = true;
                }

                if ($flag) {
                    $payload = view('td.property-edit-issuance',
                        compact('rp_id', 'header_id', 'detail_id', 'header', 'data', 'parameter'));

                    return response()->json([
                        'payload'       => $payload->render(),
                        'detail'        => $detail,
                        'types'         => $data['property_types'],
                        'uses'          => $data['property_uses'],
                        'cities'        => $data['cities'],
                        'amount_max'    => $parameter->amount_max,
                        'exchange_rate' => $exchange_rate,
                        'currency'      => $header->currency,
                    ]);
                }
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param PropertyEditFormRequest $request
     * @param string                  $rp_id
     * @param string                  $header_id
     * @param string                  $detail_id
     *
     * @return
     */
    public function updateIssuance(PropertyEditFormRequest $request, $rp_id, $header_id, $detail_id = null)
    {
        if (request()->ajax()) {
            if ($this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
                $retailerProduct = $this->retailerProductRepository->getModel();

                if ($this->repository->getDetailById(decode($detail_id))) {
                    if ($this->repository->updatePropertyIssuance($request)) {
                        $detail = $this->repository->getModel();

                        if (Cache::has(decode($header_id)) && $request->has('coverage')) {
                            goto StoreVehicle;
                        }

                        /*if ($this->facultativeRepository->storeTdFacultative($detail, $retailerProduct,
                            $request->user())
                        ) {
                            $this->headerRepository->setHeaderFacultative(decode($header_id));

                            return response()->json([
                                'location' => route('td.edit', [
                                    'rp_id'     => $rp_id,
                                    'header_id' => $header_id,
                                    $request->get('idf') ? 'idf=' . $request->get('idf') : null
                                ])
                            ]);
                        }*/
                    }
                } elseif (Cache::has(decode($header_id)) && $request->has('coverage') && $this->headerRepository->getHeaderById(decode($header_id))) {
                    $header = $this->headerRepository->getModel();

                    if ($this->repository->storeProperty($request, $header, true)) {
                        $detail = $this->repository->getModel();

                        StoreVehicle:
                        $sf = $this->facultativeRepository->storeTdFacultative($detail, $retailerProduct,
                            $request->user(), true);

                        if ($sf === 428) {
                            $errors = $this->facultativeRepository->getErrors();

                            return response()->json([ 'reason' => $errors['reason'] ], 428);
                        }

                        return response()->json([
                            'location' => route('td.coverage.edit', [
                                'rp_id'     => $rp_id,
                                'de_id'     => $request->get('coverage'),
                                'header_id' => $header_id,
                            ])
                        ]);

                    }
                }
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

        return redirect()->back();
    }

}
