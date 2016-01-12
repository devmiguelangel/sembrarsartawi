<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Http\Request;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\De\FacultativeFormRequest;
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

                return response()->json([
                    'payload' => view('de.facultative.edit', compact('fa'))->render(),
                    'states'  => $this->stateRepository->getStatus(),
                ]);
            }

            return response()->json(['err'=>'Unauthorized action.'], 401);
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request|FacultativeFormRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(FacultativeFormRequest $request, $id)
    {
        if ($request->ajax()) {
            if ($this->repository->getFacultativeById(decode($id))) {
                $fa = $this->repository->getModel();

                dd($fa);
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
