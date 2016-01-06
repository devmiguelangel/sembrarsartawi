<?php

namespace Sibas\Http\Controllers\De;

use Sibas\Entities\De\Beneficiary;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\De\BeneficiaryDeFormRequest;
use Sibas\Repositories\De\BeneficiaryRepository;
use Sibas\Repositories\De\DetailRepository;
use Sibas\Repositories\Retailer\CityRepository;

class BeneficiaryController extends Controller
{
    /**
     * @var BeneficiaryRepository
     */
    protected $repository;
    /**
     * @var DetailRepository
     */
    private $detailRepository;
    /**
     * @var CityRepository
     */
    private $cityRepository;

    public function __construct(BeneficiaryRepository $repository,
                                DetailRepository $detailRepository,
                                CityRepository $cityRepository)
    {
        $this->repository       = $repository;
        $this->detailRepository = $detailRepository;
        $this->cityRepository   = $cityRepository;
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
     * @param $rp_id
     * @param $header_id
     * @param $detail_id
     * @return \Illuminate\Http\Response
     */
    public function create($rp_id, $header_id, $detail_id)
    {
        if (request()->ajax()) {
            if ($this->detailRepository->getDetailById(decode($detail_id))) {
                $detail      = $this->detailRepository->getModel();
                $beneficiary = new Beneficiary();

                $data = [
                    'cities' => $this->cityRepository->getCitiesByType(),
                ];

                $response = view('beneficiary.create', compact('rp_id', 'header_id', 'detail', 'beneficiary', 'data'));

                return response()->json([
                    'payload' => $response->render()
                ]);
            }
        }

        return response()->json(['err'=>'Unauthorized action.'], 401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BeneficiaryDeFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeneficiaryDeFormRequest $request, $rp_id, $header_id, $detail_id)
    {
        return response()->json([
            'location' => route('de.edit', compact('rp_id', 'header_id'))
        ]);
        
        if ($request->ajax()) {
            if ($this->detailRepository->getDetailById(decode($detail_id))) {
                $request['detail'] = $this->detailRepository->getModel();

                if ($this->repository->storeBeneficiary($request)) {
                    return response()->json([
                        'location' => route('de.edit', compact('rp_id', 'header_id'))
                    ]);

                    /*return redirect()->route('de.edit', compact('rp_id', 'header_id'))
                        ->with(['success_beneficiary' => 'El Beneficiario fue registrado coxn éxito']);*/
                }
            }
        }

        return response()->json(['err'=>'Unauthorized action.'], 401);

        /*return redirect()->back()
            ->with(['error_beneficiary' => 'El Beneficiario no puede ser registrado'])
            ->withInput()->withErrors($this->repository->getErrors());*/
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

        if ($this->detailRepository->getDetailById(decode($detail_id))) {
            $detail      = $this->detailRepository->getModel();
            $beneficiary = $detail->beneficiary;

            $data = [
                'cities' => $this->cityRepository->getCitiesByType(),
            ];

            return view('beneficiary.edit', compact('rp_id', 'header_id', 'detail', 'beneficiary', 'data'));
        }

        return redirect()->back()
            ->with(['error_beneficiary' => 'No se puede editar el Beneficiario']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BeneficiaryDeFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(BeneficiaryDeFormRequest $request, $rp_id, $header_id, $detail_id)
    {
        if ($this->detailRepository->getDetailById(decode($detail_id))) {
            $request['detail'] = $this->detailRepository->getModel();

            if ($this->repository->updateBeneficiary($request)) {
                return redirect()->route('de.edit', compact('rp_id', 'header_id'))
                    ->with(['success_beneficiary' => 'El Beneficiario fue actualizado correctamente']);
            }
        }

        return redirect()->back()
            ->with(['error_beneficiary' => 'El Beneficiario no puede ser actualizado'])
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
