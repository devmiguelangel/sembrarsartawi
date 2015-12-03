<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Sibas\Http\Controllers\Client\ClientController;
use Sibas\Http\Controllers\Retailer\RetailerProductController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Client\ClientComplementFormRequest;
use Sibas\Http\Requests\Client\ClientCreateFormRequest;
use Sibas\Http\Requests\De\BalanceFormRequest;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\De\DetailRepository;
use Sibas\Repositories\De\FacultativeRepository;
use Sibas\Repositories\De\HeaderRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;

class DetailController extends Controller
{
    /**
     * @var DetailRepository
     */
    protected $repository;
    /**
     * @var ClientController
     */
    private $client;
    /**
     * @var HeaderController
     */
    private $header;

    public function __construct(DetailRepository $repository)
    {
        $this->repository      = $repository;
        $this->client          = new ClientController(new ClientRepository);
        $this->header          = new HeaderController(new HeaderRepository);
        $this->retailerProduct = new RetailerProductController(new RetailerProductRepository);
        $this->facultative     = new FacultativeController(new FacultativeRepository);
    }

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
     * Show the form for creating a new resource.
     *
     * @param string $rp_id
     * @param string $header_id
     * @param null $client_id
     * @return Response
     */
    public function create($rp_id, $header_id, $client_id = null)
    {
        return $this->client->create($rp_id, $header_id, $client_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientCreateFormRequest $request
     * @return Response
     */
    public function store(ClientCreateFormRequest $request)
    {
        $rp_id = decrypt($request->get('rp_id'));

        if ($this->header->headerById(decode($request->get('header_id')))) {
            $header            = $this->header->getHeader();
            $request['header'] = $header;

            if ($this->client->store($request) && $this->retailerProduct->retailerProductById($rp_id)) {
                $client            = $this->client->getClient();
                $retailerProduct   = $this->retailerProduct->getRetailerProduct();

                $request['client']          = $client;
                $request['retailerProduct'] = $retailerProduct;

                if ($this->repository->createDetail($request)) {
                    $detail = $this->repository->getModel();

                    return redirect()->route('de.question.create', [
                            'rp_id'     => decrypt($request->get('rp_id')),
                            'header_id' => encode($header->id),
                            'detail_id' => encode($detail->id),
                        ])->with(['success_client' => 'La información del Cliente fue registrada']);
                }
            }
        }

        return redirect()->back()
            ->with(['error_detail' => 'El Cliente no pudo ser registrado'])
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
     * @param $rp_id
     * @param $header_id
     * @param $detail_id
     * @return Response
     */
    public function edit($rp_id, $header_id, $detail_id)
    {
        if ($this->repository->getDetailById(decode($detail_id))) {
            $detail = $this->repository->getModel();

            if (! is_null($detail->client)) {
                return $this->client->edit($rp_id, $header_id, $detail_id, $detail->client);
            }
        }

        return redirect()->back()->with(['error_client_edit' => 'El Cliente no existe']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClientCreateFormRequest $request
     * @param $rp_id
     * @param $header_id
     * @param $detail_id
     * @return Response
     */
    public function update(ClientCreateFormRequest $request, $rp_id, $header_id, $detail_id)
    {
        if ($this->repository->getDetailById(decode($request->get('detail_id')))) {
            $detail = $this->repository->getModel();

            return $this->client->update($request, $rp_id, $header_id, $detail->client);
        }

        return redirect()->back()
            ->with(['error_client_edit' => 'La información del Cliente no puede ser actualizada'])
            ->withInput()->withErrors($this->repository->getErrors());
    }

    /**
     * Show the form for add complementary data.
     *
     * @param $rp_id
     * @param $header_id
     * @param $detail_id
     * @param null $ref
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editIssue($rp_id, $header_id, $detail_id, $ref = null)
    {
        $ref = strtoupper($ref);

        if ($this->repository->getDetailById(decode($detail_id))) {
            $detail = $this->repository->getModel();

            if ($ref === 'ISE' || $ref === 'ISU') {
                $data   = $this->client->getData();
                $client = $detail->client;

                if (! is_null($client)) {
                    if ($ref === 'ISE') {
                        return view('client.de.detail-edit', compact('rp_id', 'header_id', 'ref', 'data', 'detail'));
                    } elseif (strtoupper($ref) === 'ISU') {
                        // return view('client.de.edit', compact('rp_id', 'header_id', 'data', 'client'));
                    }
                }
            }
        }

        return redirect()->back()
            ->with(['error_client' => 'La información del Cliente no puede ser editada']);
    }

    public function updateIssue(ClientComplementFormRequest $request)
    {
        $ref = strtoupper(decrypt($request->get('ref')));

        if ($this->repository->getDetailById(decode($request->get('detail_id')))) {
            $detail            = $this->repository->getModel();
            $request['detail'] = $detail;

            if ($ref === 'ISE' || $ref === 'ISU') {
                if (! is_null($detail->client) && $this->client->updateIssue($request)) {
                    return redirect()->route('de.edit', [
                        'rp_id'     => decrypt($request->get('rp_id')),
                        'header_id' => $request->get('header_id')
                    ])->with(['success_client' => 'La información del Cliente se actualizó correctamente']);
                }
            };
        }

        return redirect()->back()
            ->with(['error_client' => 'La información del Cliente no pudo ser actualizada'])
            ->withInput()->withErrors($this->repository->getErrors());
    }

    public function editBalance($rp_id, $header_id, $detail_id)
    {
        if ($this->header->headerById(decode($header_id)) && $this->repository->getDetailById(decode($detail_id))) {
            $header = $this->header->getHeader();
            $detail = $this->repository->getModel();

            return view('client.de.balance', compact('rp_id', 'header', 'detail'));
        }

        return redirect()->back()
            ->with(['error_detail' => 'El Saldo Deudor no puede ser editado']);
    }

    public function updateBalance(BalanceFormRequest $request)
    {
        $rp_id     = decrypt($request->get('rp_id'));
        $header_id = $request->get('header_id');
        $detail_id = decode($request->get('detail_id'));

        if ($this->header->headerById(decode($header_id))) {
            $header            = $this->header->getHeader();
            $request['header'] = $header;

            if ($this->repository->updateBalance($request, $detail_id)
                    && $this->repository->getDetailById($detail_id)
                    && $this->retailerProduct->retailerProductById($rp_id)) {
                $detail            = $this->repository->getModel();
                $retailerProduct   = $this->retailerProduct->getRetailerProduct();

                $request['detail']          = $detail;
                $request['retailerProduct'] = $retailerProduct;

                $approved = true;
                if ($this->facultative->store($request)) {
                    $approved = false;
                }

                $this->repository->setApprovedDetail($detail, $approved);

                return redirect()->route('de.edit', compact('rp_id', 'header_id'))
                    ->with(['success_detail' => 'El Saldo Deudor fue actualizado correctamente']);
            }
        }

        return redirect()->back()
            ->with(['error_detail' => 'El Saldo Deudor no puede ser actualizado'])
            ->withInput()->withErrors($this->repository->getErrors());
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

    /** Find Detail by Id
     *
     * @param $detail_id
     * @return bool
     */
    public function detailById($detail_id)
    {
        return $this->repository->getDetailById($detail_id);
    }

    public function getDetail()
    {
        return $this->repository->getModel();
    }
}
