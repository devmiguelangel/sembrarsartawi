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
use Sibas\Repositories\UserRepository;

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
    /**
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @var int
     */
    protected $approved;

    public function __construct(FacultativeRepository $repository,
                                HeaderRepository $headerRepository,
                                StateRepository $stateRepository,
                                UserRepository $userRepository)
    {
        $this->repository       = $repository;
        $this->headerRepository = $headerRepository;
        $this->stateRepository  = $stateRepository;
        $this->userRepository   = $userRepository;
        $this->approved         = null;
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

                    $this->approved = (int) $request->get('approved');

                    if ($this->approved === 1 || $this->approved === 2) {
                        $this->headerRepository->setApproved($header);
                    }

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

    /**
     * @param Request $request
     * @param string $rp_id
     * @param Facultative $fa
     * @param Header $header
     */
    public function sendProcessMail($request, $rp_id, $fa, $header)
    {
        if (is_int($this->approved)) {
            $user     = $request->user();
            $users    = $this->userRepository->getUserByProfile($user, ['COP']);
            $receiver = [];
            $subject  = ' :process : Respuesta de la aseguradora a Caso Facultativo No. '
                        . $header->prefix . '-' . $header->issue_number
                        . $fa->detail->client->full_name;
            $process  = '';
            $template = 'emails.de.facultaive.';

            foreach ($users as $user) {
                array_push($receiver, [
                    'email' => $user->email,
                    'name'  => $user->full_name,
                ]);
            }

            switch ($this->approved) {
                case 1:
                    $process  = 'Aprobado';
                    $template .= '';
                    break;
                case 0:
                    $process  = 'Rechazado';
                    $template .= '';
                    break;
                case 2:
                    $process  = $fa->observations->last()->state->state;
                    $template .= '';
                    break;
            }

            $subject = str_replace(':process', $process, $subject);

            $mail = new MailController($user, $template, [], $subject, $receiver);
        }
    }

}
