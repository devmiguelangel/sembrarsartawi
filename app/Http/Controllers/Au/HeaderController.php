<?php

namespace Sibas\Http\Controllers\Au;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Sibas\Entities\Client;
use Sibas\Http\Controllers\DataTrait;
use Sibas\Http\Controllers\MailController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Au\ClientComplementFormRequest;
use Sibas\Http\Requests\Au\FacultativeRequestFormRequest;
use Sibas\Http\Requests\Au\HeaderCreateFormRequest;
use Sibas\Http\Requests\Au\HeaderEditFormRequest;
use Sibas\Repositories\Au\FacultativeRepository;
use Sibas\Repositories\Au\HeaderRepository;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\Retailer\PolicyRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;

class HeaderController extends Controller
{

    /**
     * @var ClientRepository
     */
    protected $clientRepository;

    /**
     * @var HeaderRepository
     */
    protected $repository;

    /**
     * @var RetailerProductRepository
     */
    protected $retailerProductRepository;

    /**
     * @var PolicyRepository
     */
    protected $policyRepository;

    /**
     * @var FacultativeRepository
     */
    protected $facultativeRepository;


    public function __construct(
        HeaderRepository $repository,
        ClientRepository $clientRepository,
        FacultativeRepository $facultativeRepository,
        RetailerProductRepository $retailerProductRepository,
        PolicyRepository $policyRepository
    ) {
        $this->repository                = $repository;
        $this->clientRepository          = $clientRepository;
        $this->retailerProductRepository = $retailerProductRepository;
        $this->policyRepository          = $policyRepository;
        $this->facultativeRepository     = $facultativeRepository;
    }


    use DataTrait;


    /**
     *
     * Show the form for creating a new resource.
     *
     * @param string $rp_id
     *
     * @return mixed
     */
    public function create($rp_id)
    {
        $client = new Client();

        if (session('client')) {
            $client = session('client');
        }

        $data                    = $this->getData($rp_id);
        $data['payment_methods'] = $this->retailerProductRepository->getPaymentMethodsByProductById(decode($rp_id));

        return view('au.create', compact('rp_id', 'data', 'client'));
    }


    /**
     *
     *  Store a newly created resource in storage.
     *
     * @param HeaderCreateFormRequest $request
     * @param string                  $rp_id
     *
     * @return mixed
     */
    public function store(HeaderCreateFormRequest $request, $rp_id)
    {
        if ($this->clientRepository->createClient($request)) {
            $client = $this->clientRepository->getModel();

            if ($this->repository->storeHeader($request, $client)) {
                $header = $this->repository->getModel();

                return redirect()->route('au.vh.lists', [
                    'rp_id'     => $rp_id,
                    'header_id' => encode($header->id),
                ])->with([ 'success_header' => 'La cotización fue registrada con éxito.' ]);
            }
        }

        return redirect()->back()->with([ 'error_header' => 'El Cliente no pudo ser registrado' ])->withInput()->withErrors($this->repository->getErrors());
    }


    /**
     * @param string $rp_id
     * @param string $header_id
     */
    public function result($rp_id, $header_id)
    {
        if ($this->repository->getHeaderById(decode($header_id)) && $this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
            $header          = $this->repository->getModel();
            $retailerProduct = $this->retailerProductRepository->getModel();

            if ($this->repository->setVehicleResult($retailerProduct, $header)) {
                return view('au.result', compact('rp_id', 'header_id', 'header', 'retailerProduct'));
            }
        }

        return redirect()->back()->with([ 'error_header' => 'No se posible calcular la prima.' ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $rp_id
     * @param $header_id
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function edit($rp_id, $header_id)
    {
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();
            $data   = [
                'policies' => $this->policyRepository->getPolicyByCurrency(decode($rp_id), $header->currency)
            ];

            return view('au.edit', compact('rp_id', 'header_id', 'header', 'data'));
        }

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param HeaderEditFormRequest $request
     * @param string                $rp_id
     * @param string                $header_id
     */
    public function update(HeaderEditFormRequest $request, $rp_id, $header_id)
    {
        if ($this->repository->getHeaderById(decode($header_id))) {
            if ($this->repository->updateHeader($request)) {
                return redirect()->route('au.edit', [
                    'rp_id'     => $rp_id,
                    'header_id' => $header_id,
                ])->with([ 'success_header' => 'La Póliza fue actualizada con éxito.' ]);
            }
        }

        return redirect()->back()->withInput();
    }


    /**
     * @param string $rp_id
     * @param string $header_id
     * @param string $client_id
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function editClient($rp_id, $header_id, $client_id)
    {
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();
            $client = $header->client;

            if ($client instanceof Client && $client->id == decode($client_id)) {
                $data = $this->getData($rp_id);

                return view('client.au.edit-issuance', compact('rp_id', 'header_id', 'client_id', 'client', 'data'));
            }
        }

        return redirect()->back();
    }


    /**
     * @param ClientComplementFormRequest $request
     * @param string                      $rp_id
     * @param string                      $header_id
     * @param string                      $client_id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateClient(ClientComplementFormRequest $request, $rp_id, $header_id, $client_id)
    {
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();

            if (( $header->client instanceof Client && $header->client->id == decode($client_id) ) && $this->clientRepository->updateIssueClient($request,
                    $header->client)
            ) {
                return redirect()->route('au.edit', [
                    'rp_id'     => $rp_id,
                    'header_id' => $header_id,
                    $request->get('idf') ? 'idf=' . $request->get('idf') : null
                ])->with([ 'success_client' => 'La información del Cliente se actualizó correctamente' ]);
            }
        }

        return redirect()->back()->with([ 'error_client' => 'La información del Cliente no pudo ser actualizada' ])->withInput()->withErrors($this->repository->getErrors());
    }


    /**
     * Header show issuance
     */
    public function showIssuance($rp_id, $header_id)
    {
        $this->retailerProductRepository->getRetailerProductById(decode($rp_id));
        $rp = $this->retailerProductRepository->getModel();
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();

            if ($header->issued) {
                return view('au.issuance', compact('rp_id', 'header_id',
                    'header', 'rp'))->with([ 'success_header' => 'La Póliza fue emitida con éxito.' ]);
            }
        }

        return redirect()->back();
    }


    /**
     * Header update issuance
     *
     * @param string $rp_id
     * @param string $header_id
     *
     * @return
     */
    public function updateIssuance($rp_id, $header_id)
    {
        if ($this->repository->getHeaderById(decode($header_id))) {
            if ($this->repository->issuanceHeader()) {
                return redirect()->route('au.show.issuance', [
                    'rp_id'     => $rp_id,
                    'header_id' => $header_id,
                ])->with([ 'success_header' => 'La Póliza fue emitida con éxito.' ]);
            }
        }

        return redirect()->back();
    }


    /**
     * @param string $rp_id
     * @param string $header_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestCreate($rp_id, $header_id)
    {
        if (request()->ajax()) {
            if ($this->repository->getHeaderById(decode($header_id))) {
                $header = $this->repository->getModel();

                if ($header->facultative) {
                    $payload = view('au.facultative.request', compact('rp_id', 'header'));

                    return response()->json([
                        'payload'                 => $payload->render(),
                        'facultative_observation' => strip_tags($header->facultative_observation),
                    ]);
                }
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

        return redirect()->back();
    }


    /**
     * @param FacultativeRequestFormRequest $request
     * @param string                        $rp_id
     * @param string                        $header_id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function requestStore(FacultativeRequestFormRequest $request, $rp_id, $header_id)
    {
        if ($request->ajax()) {
            if ($this->repository->getHeaderById(decode($header_id)) && $this->repository->storeFacultative($request)) {
                $header = $this->repository->getModel();

                $mail = new MailController($request->user());

                $mail->subject  = 'Solicitud de aprobación: Caso Facultativo No. ' . $header->prefix . ' - ' . $header->issue_number;
                $mail->template = 'au.request-approval';

                if ($mail->send(decode($rp_id), [ 'header' => $header ], 'COP')) {
                    $this->repository->storeSent();
                }

                return response()->json([
                    'location' => route('au.edit', compact('rp_id', 'header_id'))
                ]);
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param HeaderEditFormRequest $request
     *
     * @return Response
     */
    public function updateFa(HeaderEditFormRequest $request, $rp_id, $header_id, $id_facultative)
    {
        if ($this->repository->updateHeaderFacultative($request, decode($header_id))) {
            $mail = new MailController($request->user());

            $this->facultativeRepository->approved = 2;
            $this->facultativeRepository->sendProcessMail($mail, $rp_id, $id_facultative, true);

            return redirect()->route('home')->with([ 'success_header' => 'La Póliza fue actualizada con éxito.' ]);
        }

        return redirect()->back()->with([ 'error_header' => 'La Póliza no pudo ser actualizada.' ])->withInput()->withErrors($this->repository->getErrors());
    }

}
