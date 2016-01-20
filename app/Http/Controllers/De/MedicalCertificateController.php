<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Http\Request;

use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\De\MedicalCertificateFormRequest;
use Sibas\Repositories\De\FacultativeRepository;
use Sibas\Repositories\De\MedicalCertificateRepository;

class MedicalCertificateController extends Controller
{
    /**
     * @var FacultativeRepository
     */
    protected $facultativeRepository;
    /**
     * @var MedicalCertificateRepository
     */
    protected $repository;

    public function __construct(MedicalCertificateRepository $repository, FacultativeRepository $facultativeRepository)
    {
        $this->repository            = $repository;
        $this->facultativeRepository = $facultativeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $rp_id
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function create($rp_id, $id)
    {
        if (request()->ajax()) {
            if ($this->facultativeRepository->getFacultativeById(decode($id))
                && $this->repository->getMedicalCertificateByProduct(decode($rp_id))) {

                $fa = $this->facultativeRepository->getModel();
                $mc = $this->repository->getModel();

                return response()->json([
                    'payload' => view('de.mc.create', compact('rp_id', 'id', 'fa', 'mc'))->render()
                ]);
            }

            return response()->json(['err'=>'Unauthorized action.'], 401);
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MedicalCertificateFormRequest $request
     * @param string $rp_id
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function store(MedicalCertificateFormRequest $request, $rp_id, $id)
    {
        if ($request->ajax()) {
            if ($this->facultativeRepository->getFacultativeById(decode($id))
                && $this->repository->storeMedicalCertificate($request)) {

                $mc = $this->repository->getModel();

                return response()->json([
                    'mc' => $mc
                ]);
            }
        }

        return redirect()->back();
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
