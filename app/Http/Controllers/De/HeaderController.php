<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Sibas\Entities\De\Facultative;
use Sibas\Entities\Rate;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Controllers\MailController;
use Sibas\Http\Requests\De\FacultativeRequestFormRequest;
use Sibas\Http\Requests\De\HeaderCreateFormRequest;
use Sibas\Http\Requests\De\HeaderEditFormRequest;
use Sibas\Http\Requests\De\HeaderResultFormRequest;
use Sibas\Repositories\De\DataRepository;
use Sibas\Repositories\De\HeaderRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;
use Sibas\Repositories\UserRepository;

class HeaderController extends Controller
{
    /**
     * @var HeaderRepository
     */
    protected $repository;
    /**
     * @var DataRepository
     */
    protected $dataRepository;
    /**
     * @var RetailerProductRepository
     */
    protected $retailerProductRepository;
    /**
     * @var Rate
     */
    protected $rate;
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(HeaderRepository $repository,
                                DataRepository $dataRepository,
                                RetailerProductRepository $retailerProductRepository,
                                UserRepository $userRepository)
    {
        $this->repository                = $repository;
        $this->dataRepository            = $dataRepository;
        $this->retailerProductRepository = $retailerProductRepository;
        $this->userRepository            = $userRepository;
    }

    /**
     * Returns data for create Header
     *
     * @param $rp_id
     * @return array
     */
    protected function getData($rp_id)
    {
        return [
            'coverages'  => $this->retailerProductRepository->getCoverageByProduct($rp_id),
            'currencies' => $this->dataRepository->getCurrency(),
            'term_types' => $this->dataRepository->getTermType(),
        ];
    }

    /**
     * Display a listing of the Clients.
     *
     * @param $rp_id
     * @param $header_id
     * @return Response
     */
    public function lists($rp_id, $header_id)
    {
        $header = null;

        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();
        }

        return view('de.list', compact('rp_id', 'header_id', 'header'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param String $rp_id
     * @return Response
     */
    public function create($rp_id)
    {
        $data = $this->getData(decode($rp_id));

        return view('de.create', compact('rp_id', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HeaderCreateFormRequest $request
     * @param $rp_id
     * @return Response
     */
    public function store(HeaderCreateFormRequest $request, $rp_id)
    {
        if ($this->repository->createHeader($request)) {
            $header = $this->repository->getModel();

            return redirect()->route('de.client.list', [
                'rp_id'     => $rp_id,
                'header_id' => encode($header->id),
            ])->with(['success_header' => 'La cotización fue registrada con éxito.']);
        }

        return redirect()->back()
            ->with(['error_header' => 'La cotización no pudo ser registrada'])
            ->withInput()->withErrors($this->repository->getErrors());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String $rp_id
     * @param  String $header_id
     * @return Response
     */
    public function edit($rp_id, $header_id)
    {
        $header = null;
        $data   = null;

        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();
            $data   = $this->getData(decode($rp_id));

            $cumulus = $header->details->sum(function($detail) {
                return $detail->cumulus;
            });

            $header->cumulus = $cumulus;
        }

        return view('de.edit', compact('rp_id', 'header_id', 'header', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HeaderEditFormRequest $request
     * @return Response
     */
    public function update(HeaderEditFormRequest $request, $rp_id, $header_id)
    {
        if ($this->repository->updateHeader($request, decode($header_id))) {
            return redirect()->route('de.edit', [
                'rp_id'     => $rp_id,
                'header_id' => $header_id,
            ])->with(['success_header' => 'La Póliza fue actualizada con éxito.']);
        }

        return redirect()->back()
            ->with(['error_header' => 'La Póliza no pudo ser actualizada.'])
            ->withInput()->withErrors($this->repository->getErrors());
    }

    /**
     * Show all options for Company
     *
     * @param $rp_id
     * @param $header_id
     * @return \Illuminate\View\View
     */
    public function result($rp_id, $header_id)
    {
        $retailer = request()->user()->retailer->first();

        return view('de.result', compact('rp_id', 'header_id', 'retailer'));
    }

    /**
     * Store data for Result Quote
     *
     * @param HeaderResultFormRequest $request
     * @return $this
     */
    public function storeResult(HeaderResultFormRequest $request, $rp_id, $header_id)
    {
        $this->rate      = Rate::where('id', $request->get('rate_id'))->first();
        $request['rate'] = $this->rate;

        if ($this->repository->storeResult($request, decode($header_id))) {
            return redirect()->route('de.edit', [
                'rp_id'     => $rp_id,
                'header_id' => $header_id,
            ])->with(['success_header' => 'La tasa fue registrada correctamente']);
        }

        return redirect()->back()->with(['error_header' => 'La tasa no pudo ser registrada']);
    }

    public function issue($rp_id, $header_id)
    {
        if ($this->repository->issueHeader($header_id)) {
            return redirect()->route('de.issuance', [
                'rp_id'     => $rp_id,
                'header_id' => $header_id,
            ])->with(['success_header' => 'La Poliza fue emitida con exito']);
        }

        return redirect()->back()
            ->with('error_header', 'La Poliza no puede ser emitida');
    }

    public function issuance($rp_id, $header_id)
    {
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();

            $subProducts = $this->retailerProductRepository->getSubProductByIdProduct(decode($rp_id));

            return view('de.issuance', compact('rp_id', 'header_id', 'header', 'subProducts'));

        }

        return redirect()->back();
    }

    public function viSPList($rp_id, $header_id, $sp_id)
    {
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();

            return view('vi.sp.list', compact('rp_id', 'header_id', 'header', 'sp_id'));
        }

        return redirect()->back()
            ->with(['error_header' => 'El numero de Poliza no existe']);
    }

    public function viSPListStore(Request $request)
    {
        if ($request->has('clients')) {
            $rp_id     = $request->get('rp_id');
            $header_id = $request->get('header_id');
            $sp_id     = $request->get('sp_id');
            $clients   = $request->get('clients');

            $this->repository->setClientCacheSP($header_id, $clients);

            return redirect()->route('de.vi.sp.create', [
                'rp_id'     => decrypt($rp_id),
                'header_id' => $header_id,
                'sp_id'     => $sp_id,
            ]);
        }

        return redirect()->back()
            ->with(['error_cache' => 'El Sub-Producto no puede ser procesado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $rp_id
     * @param $header_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function requestCreate($rp_id, $header_id)
    {
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();

            $observation = '';

            foreach ($header->details as $detail) {
                if (! $detail->approved && ($detail->facultative instanceof Facultative)) {
                    $observation .= $detail->facultative->reason;
                }
            }

            if (! empty($observation)) {
                $header->facultative_observation = $observation;
                return view('de.facultative.request', compact('rp_id', 'header'));
            }
        }

        return redirect()->back()
            ->with(['error_header' => 'La solicitud no puede ser enviada']);
    }

    /**
     * @param FacultativeRequestFormRequest $request
     * @param $rp_id
     * @param $header_id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function requestStore(FacultativeRequestFormRequest $request, $rp_id, $header_id)
    {
        if ($this->repository->storeFacultative($request, decode($header_id))) {
            $header   = $this->repository->getModel();
            $subject  = 'Solicitud de aprobación: Caso Facultativo No. ' . $header->issue_number;
            $users    = $this->userRepository->getUserByProfile($request->user(), ['COP']);
            $receiver = [];

            foreach ($users as $user) {
                array_push($receiver, [
                    'email' => $user->email,
                    'name'  => $user->full_name,
                ]);
            }

            $mail = new MailController($request->user(), 'de.request-approval', [], $subject, $receiver);

            if ($mail->send(decode($rp_id), ['header' => $header])) {
                $this->repository->storeSent($header);
            }

            return redirect()->route('de.edit', compact('rp_id', 'header_id'))
                ->with(['success_header' => 'La solicitud fue enviada']);
        }

        return redirect()->back()
            ->with(['error_header' => 'La solicitud no pudo ser enviada']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HeaderEditFormRequest $request
     * @return Response
     */
    public function updateFa(HeaderEditFormRequest $request, $rp_id, $header_id)
    {
        if ($this->repository->updateHeaderFacultative($request, decode($header_id))) {
            return redirect()->route('home')
                ->with(['success_header' => 'La Póliza fue actualizada con éxito.']);
        }

        return redirect()->back()
            ->with(['error_header' => 'La Póliza no pudo ser actualizada.'])
            ->withInput()->withErrors($this->repository->getErrors());
    }
}
