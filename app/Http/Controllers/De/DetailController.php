<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Http\Response;
use Sibas\Entities\Client;
use Sibas\Entities\De\Detail;
use Sibas\Http\Controllers\DataTrait;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Client\ClientComplementFormRequest;
use Sibas\Http\Requests\Client\ClientCreateFormRequest;
use Sibas\Http\Requests\De\BalanceFormRequest;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\De\DetailRepository;
use Sibas\Repositories\De\FacultativeRepository;
use Sibas\Repositories\De\HeaderRepository;

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
     * @var ClientRepository
     */
    protected $clientRepository;

    /**
     * @var FacultativeRepository
     */
    protected $facultativeRepository;

    protected $reference;


    public function __construct(
        DetailRepository $repository,
        HeaderRepository $headerRepository,
        ClientRepository $clientRepository,
        FacultativeRepository $facultativeRepository
    ) {
        $this->repository            = $repository;
        $this->headerRepository      = $headerRepository;
        $this->clientRepository      = $clientRepository;
        $this->facultativeRepository = $facultativeRepository;

        $this->reference = [ 'ISE', 'ISU' ];
    }


    use DataTrait;


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new Client.
     *
     * @param string $rp_id
     * @param string $header_id
     * @param null   $client_id
     *
     * @return Response
     */
    public function create($rp_id, $header_id, $client_id = null)
    {
        $data   = $this->getData($rp_id);
        $client = new Client();

        if (session('client') && session('client') instanceof Client) {
            $client = session('client');
        } elseif ( ! is_null($client_id) && $this->clientRepository->getClientById(decode($client_id))) {
            $client = $this->clientRepository->getModel();
        }

        return view('client.de.create', compact('rp_id', 'header_id', 'data', 'client'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientCreateFormRequest $request
     * @param                          $rp_id
     * @param                          $header_id
     *
     * @return Response
     */
    public function store(ClientCreateFormRequest $request, $rp_id, $header_id)
    {
        if ($this->headerRepository->getHeaderById(decode($header_id))) {
            $request['header'] = $this->headerRepository->getModel();

            if ($this->clientRepository->createClient($request)) {
                $request['client'] = $this->clientRepository->getModel();

                if ($this->repository->createDetail($request)) {
                    $detail = $this->repository->getModel();

                    return redirect()->route('de.question.create', [
                        'rp_id'     => $rp_id,
                        'header_id' => $header_id,
                        'detail_id' => encode($detail->id),
                    ])->with([ 'success_client' => 'La información del Cliente fue registrada' ]);
                }
            }
        }

        return redirect()->back()->with([ 'error_detail' => 'El Cliente no pudo ser registrado' ])->withInput()->withErrors($this->repository->getErrors());
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
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
     *
     * @return Response
     */
    public function edit($rp_id, $header_id, $detail_id)
    {
        if ($this->repository->getDetailById(decode($detail_id))) {
            $detail = $this->repository->getModel();

            if ($detail->client instanceof Client) {
                $client = $detail->client;
                $data   = $this->getData($rp_id);

                return view('client.de.edit', compact('rp_id', 'header_id', 'detail_id', 'data', 'client'));
            }
        }

        return redirect()->back()->with([ 'error_client_edit' => 'El Cliente no existe' ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ClientCreateFormRequest $request
     * @param                          $rp_id
     * @param                          $header_id
     * @param                          $detail_id
     *
     * @return Response
     */
    public function update(ClientCreateFormRequest $request, $rp_id, $header_id, $detail_id)
    {
        if ($this->repository->getDetailById(decode($detail_id))) {
            $detail = $this->repository->getModel();

            if ($this->clientRepository->editClient($request, $detail->client)) {
                return redirect()->route('de.client.list', [
                    'rp_id'     => $rp_id,
                    'header_id' => $header_id
                ])->with([ 'success_client' => 'La información del Cliente se actualizó correctamente' ]);
            }
        }

        return redirect()->back()->with([ 'error_client_edit' => 'La información del Cliente no puede ser actualizada' ])->withInput()->withErrors($this->repository->getErrors());
    }


    /**
     * Show the form for add complementary data.
     *
     * @param      $rp_id
     * @param      $header_id
     * @param      $detail_id
     * @param null $ref
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editIssue($rp_id, $header_id, $detail_id, $ref = null)
    {
        $ref = strtoupper($ref);

        if ($this->repository->getDetailById(decode($detail_id))) {
            $detail = $this->repository->getModel();

            if (in_array($ref, $this->reference)) {
                $data   = $this->getData($rp_id);
                $client = $detail->client;

                if ($client instanceof Client) {
                    if ($ref === 'ISE') {
                        return view('client.de.detail-edit', compact('rp_id', 'header_id', 'ref', 'data', 'detail'));
                    } elseif (strtoupper($ref) === 'ISU') {
                        // return view('client.de.edit', compact('rp_id', 'header_id', 'data', 'client'));
                    }
                }
            }
        }

        return redirect()->back()->with([ 'error_client' => 'La información del Cliente no puede ser editada' ]);
    }


    public function updateIssue(ClientComplementFormRequest $request, $rp_id, $header_id, $detail_id, $ref)
    {
        $ref = strtoupper($ref);

        if ($this->repository->getDetailById(decode($detail_id))) {
            $detail = $this->repository->getModel();

            if (in_array($ref, $this->reference)) {
                if (( $detail->client instanceof Client ) && $this->clientRepository->updateIssueClient($request,
                        $detail->client)
                ) {
                    return redirect()->route('de.edit', [
                        'rp_id'     => $rp_id,
                        'header_id' => $header_id,
                        $request->has('_idf') ? 'idf=' . e($request->get('_idf')) : null
                    ])->with([ 'success_client' => 'La información del Cliente se actualizó correctamente' ]);
                }
            };
        }

        return redirect()->back()->with([ 'error_client' => 'La información del Cliente no pudo ser actualizada' ])->withInput()->withErrors($this->repository->getErrors());
    }


    public function editBalance($rp_id, $header_id, $detail_id)
    {
        if (request()->ajax()) {
            if ($this->headerRepository->getHeaderById(decode($header_id))) {
                $header   = $this->headerRepository->getModel();
                $detail   = $header->details()->where('id', decode($detail_id))->first();
                $retailer = request()->user()->retailer()->first();

                if ($detail instanceof Detail) {
                    $payload             = view('client.de.balance', compact('rp_id', 'header', 'detail'));
                    $amount_requested_bs = $header->currency == 'USD' ? $header->amount_requested * $retailer->exchangeRate->bs_value : $header->amount_requested;

                    return response()->json([
                        'payload'             => $payload->render(),
                        'amount_requested'    => $header->amount_requested,
                        'amount_requested_bs' => $amount_requested_bs,
                        'balance'             => $detail->balance,
                        'cumulus'             => $detail->cumulus,
                        'movement_type'       => $header->movement_type,
                    ]);
                }
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

        return redirect()->back()->with([ 'error_detail' => 'El Saldo Deudor no puede ser editado' ]);

    }


    public function updateBalance(BalanceFormRequest $request, $rp_id, $header_id, $detail_id)
    {
        if ($request->ajax()) {
            if ($this->headerRepository->getHeaderById(decode($header_id))) {
                $request['header'] = $this->headerRepository->getModel();

                if ($this->repository->updateBalance($request, decode($detail_id))) {
                    $request['detail']   = $this->repository->getModel();
                    $request['retailer'] = $request->user()->retailer->first();

                    $approved = true;
                    if ($this->facultativeRepository->storeFacultative($request, decode($rp_id))) {
                        $approved = false;
                    }

                    $header = $this->repository->getModel()->header;

                    $facultative = false;

                    if ($header->type === 'I') {
                        $facultative = $this->headerRepository->setFacultative($header);
                    }

                    $this->repository->setApprovedDetail($approved, $facultative);

                    return response()->json([
                        'location' => route('de.edit', compact('rp_id', 'header_id'))
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
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
