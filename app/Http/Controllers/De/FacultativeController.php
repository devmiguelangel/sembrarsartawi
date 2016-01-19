<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Http\Request;
use Sibas\Entities\De\Facultative;
use Sibas\Entities\De\Header;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Controllers\MailController;
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
     * @param  string $rp_id
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function edit($rp_id, $id)
    {
        if (request()->ajax()) {
            if ($this->repository->getFacultativeById(decode($id))) {
                $fa = $this->repository->getModel();

                return response()->json([
                    'payload' => view('de.facultative.edit', compact('fa', 'rp_id'))->render(),
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
     * @param string $rp_id
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function update(FacultativeFormRequest $request, $rp_id, $id)
    {
        if ($request->ajax()) {
            if ($this->repository->getFacultativeById(decode($id))) {
                if ($this->repository->updateFacultative($request)) {
                    $fa     = $this->repository->getModel();
                    $header = $fa->detail->header;

                    $this->repository->approved = (int) $request->get('approved');

                    if ($this->repository->approved === 1 || $this->repository->approved === 2) {
                        $this->headerRepository->setApproved($header);
                    }

                    $mail = new MailController($request->user());

                    $this->repository->sendProcessMail($mail, $rp_id, $id);

                    return response()->json([
                        'location' => route('home')
                    ]);
                }
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

    public function createAnswer($rp_id, $id, $id_observation)
    {
        if (request()->ajax()) {
            if ($this->repository->getFacultativeById(decode($id))) {
                $fa = $this->repository->getModel();

                return response()->json([
                    'payload' => view('de.facultative.answer', compact('fa', 'id_observation', 'rp_id'))->render()
                ]);
            }

            return response()->json(['err'=>'Unauthorized action.'], 401);
        }

        return redirect()->back();
    }

    public function storeAnswer(Request $request, $rp_id, $id, $id_observation)
    {
        $this->validate($request, [
            'observation_response' => 'required|ands_full'
        ]);

        if (request()->ajax()) {
            if ($this->repository->getFacultativeById(decode($id))) {
                if ($this->repository->storeAnswer($request, decode($id_observation))) {
                    $mail = new MailController($request->user());

                    $this->repository->approved = 2;
                    $this->repository->sendProcessMail($mail, $rp_id, $id, true);

                    return response()->json([
                        'location' => route('home')
                    ]);
                }
            }

            return response()->json(['err'=>'Unauthorized action.'], 401);
        }

        return redirect()->back();
    }

    public function observation($rp_id, $id)
    {
        if (request()->ajax()) {
            if ($this->repository->getFacultativeById(decode($id))) {
                $fa = $this->repository->getModel();

                return response()->json([
                    'payload' => view('de.facultative.observation', compact('fa'))->render()
                ]);
            }

            return response()->json(['err'=>'Unauthorized action.'], 401);
        }

        return redirect()->back();
    }

    public function response($rp_id, $id, $id_observation)
    {
        if (request()->ajax()) {
            if ($this->repository->getFacultativeById(decode($id))) {
                $fa          = $this->repository->getModel();
                $observation = $fa->observations()->where('id', decode($id_observation))->first();

                return response()->json([
                    'payload' => view('de.facultative.response', compact('fa', 'observation'))->render()
                ]);
            }

            return response()->json(['err'=>'Unauthorized action.'], 401);
        }

        return redirect()->back();
    }

    public function observationProcess($rp_id, $id)
    {
        if (request()->ajax()) {
            if ($this->repository->getFacultativeById(decode($id))) {
                $fa = $this->repository->getModel();

                return response()->json([
                    'payload' => view('de.facultative.observation-process', compact('fa'))->render()
                ]);
            }

            return response()->json(['err'=>'Unauthorized action.'], 401);
        }

        return redirect()->back();
    }

}
