<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Http\Request;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\De\FacultativeRepository;
use Sibas\Repositories\De\HeaderRepository;
use Sibas\Repositories\StateRepository;

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
     * @var StateRepository
     */
    protected $stateRepository;

    public function __construct(FacultativeRepository $repository,
                                HeaderRepository $headerRepository,
                                StateRepository $stateRepository)
    {
        $this->repository       = $repository;
        $this->headerRepository = $headerRepository;
        $this->stateRepository  = $stateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

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
        if (request()->ajax()) {
            if ($this->repository->getFacultativeById(decode($id))) {
                $fa = $this->repository->getModel();

                $data = [
                    'states' => $this->stateRepository->getStatus(),
                ];

                return response()->json([
                    'payload' => view('de.facultative.edit', compact('fa', 'data'))->render()
                ]);
            }

            return response()->json(['err'=>'Unauthorized action.'], 401);
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
        if ($request->ajax()) {
            $this->validate($request, [
                'approved'     => 'required|integer',
                'surcharge'    => 'required|integer',
                'percentage'   => 'required|integer|min:0|max:100',
                'current_rate' => 'required|numeric',
                'final_rate'   => 'required|numeric',
                'state'        => 'required|ad_states,slug',
                'observation'  => 'required|ands_full'
            ]);

            if ($this->repository->getFacultativeById(decode($id))) {
                $fa = $this->repository->getModel();
            }

            return response()->json(['err'=>'Unauthorized action.'], 401);
        }

        return redirect()->back();
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
