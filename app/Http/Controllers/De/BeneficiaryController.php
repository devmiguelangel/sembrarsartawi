<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Http\Request;
use Sibas\Entities\De\Beneficiary;
use Sibas\Http\Controllers\Retailer\CityController;
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
     * @var DetailController
     */
    private $detail;

    public function __construct(BeneficiaryRepository $repository)
    {
        $this->repository = $repository;
        $this->detail     = new DetailController(new DetailRepository);
        $this->cities     = new CityController(new CityRepository);
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
        $data = [
            'cities' => $this->cities->cityByType(),
        ];

        if ($this->detail->detailById(decode($detail_id))) {
            $detail      = $this->detail->getDetail();
            $beneficiary = new Beneficiary();

            return view('beneficiary.create', compact('rp_id', 'header_id', 'detail', 'beneficiary', 'data'));
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BeneficiaryDeFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeneficiaryDeFormRequest $request)
    {
        $rp_id     = decrypt($request->get('rp_id'));
        $header_id = $request->get('header_id');
        $detail_id = decode($request->get('detail_id'));

        if ($this->repository->storeBeneficiary($request, $detail_id)) {
            return redirect()->route('de.edit', compact('rp_id', 'header_id'));
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
     * @param $rp_id
     * @param $header_id
     * @param $detail_id
     * @return \Illuminate\Http\Response
     */
    public function edit($rp_id, $header_id, $detail_id)
    {
        $data = [
            'cities' => $this->cities->cityByType(),
        ];

        if ($this->detail->detailById(decode($detail_id))) {
            $detail      = $this->detail->getDetail();
            $beneficiary = $detail->beneficiary;

            return view('beneficiary.edit', compact('rp_id', 'header_id', 'detail', 'beneficiary', 'data'));
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BeneficiaryDeFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(BeneficiaryDeFormRequest $request)
    {
        $rp_id          = decrypt($request->get('rp_id'));
        $header_id      = $request->get('header_id');
        $beneficiary_id = decode($request->get('beneficiary_id'));

        if ($this->repository->updateBeneficiary($request, $beneficiary_id)) {
            return redirect()->route('de.edit', compact('rp_id', 'header_id'));
        }

        return redirect()->back()->withInput()->withErrors($this->repository->getErrors());
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
