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
use Sibas\Repositories\De\FacultativeRepository;
use Sibas\Repositories\De\HeaderRepository;
use Sibas\Repositories\Retailer\PolicyRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;

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
     * @var PolicyRepository
     */
    private $policyRepository;

    /**
     * @var Rate
     */
    protected $rate;

    /**
     * @var FacultativeRepository
     */
    protected $facultativeRepository;


    public function __construct(
        HeaderRepository $repository,
        DataRepository $dataRepository,
        RetailerProductRepository $retailerProductRepository,
        PolicyRepository $policyRepository,
        FacultativeRepository $facultativeRepository
    ) {
        $this->repository                = $repository;
        $this->dataRepository            = $dataRepository;
        $this->retailerProductRepository = $retailerProductRepository;
        $this->policyRepository          = $policyRepository;
        $this->facultativeRepository     = $facultativeRepository;

        $this->rate = null;
    }


    /**
     * Returns data for create Header
     *
     * @param $rp_id
     *
     * @return array
     */
    protected function getData($rp_id)
    {
        return [
            'coverages'       => $this->retailerProductRepository->getCoverageByProduct($rp_id),
            'currencies'      => $this->dataRepository->getCurrency(),
            'term_types'      => $this->dataRepository->getTermType(),
            'credit_products' => $this->retailerProductRepository->getCreditProductByProduct($rp_id),
            'movement_types'  => $this->dataRepository->getMovementType(),
            'policies'        => $this->policyRepository->gerPolicyForIssuance($rp_id),
        ];
    }


    /**
     * Display a listing of the Clients.
     *
     * @param $rp_id
     * @param $header_id
     *
     * @return Response
     */
    public function lists($rp_id, $header_id)
    {
        $header = null;

        if ($this->repository->getHeaderById(decode($header_id)) && $this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
            $header          = $this->repository->getModel();
            $retailerProduct = $this->retailerProductRepository->getModel();

            $coverage_detail = 0;

            foreach ($retailerProduct->coverages as $coverage) {
                if ($coverage->id === $header->ad_coverage_id) {
                    $coverage_detail = $coverage->pivot->detail;
                }
            }
        }

        return view('de.list', compact('rp_id', 'header_id', 'header', 'coverage_detail'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param String $rp_id
     *
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
     * @param                         $rp_id
     *
     * @return Response
     */
    public function store(HeaderCreateFormRequest $request, $rp_id)
    {
        if ($this->repository->createHeader($request)) {
            $header = $this->repository->getModel();

            return redirect()->route('de.client.list', [
                'rp_id'     => $rp_id,
                'header_id' => encode($header->id),
            ])->with([ 'success_header' => 'La cotización fue registrada con éxito.' ]);
        }

        return redirect()->back()->with([ 'error_header' => 'La cotización no pudo ser registrada' ])->withInput()->withErrors($this->repository->getErrors());
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
     * @param  String $rp_id
     * @param  String $header_id
     *
     * @return Response
     */
    public function edit($rp_id, $header_id)
    {
        $header = null;
        $data   = null;

        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();
            $data   = $this->getData(decode($rp_id));

            $cumulus = $header->details->sum(function ($detail) {
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
     *
     * @return Response
     */
    public function update(HeaderEditFormRequest $request, $rp_id, $header_id)
    {
        if ($this->repository->updateHeader($request, decode($header_id))) {
            return redirect()->route('de.edit', [
                'rp_id'     => $rp_id,
                'header_id' => $header_id,
            ])->with([ 'success_header' => 'La Póliza fue actualizada con éxito.' ]);
        }

        return redirect()->back()->with([ 'error_header' => 'La Póliza no pudo ser actualizada.' ])->withInput()->withErrors($this->repository->getErrors());
    }


    /**
     * Show all options for Company
     *
     * @param $rp_id
     * @param $header_id
     *
     * @return \Illuminate\View\View
     */
    public function result($rp_id, $header_id)
    {
        if ($this->repository->getHeaderById(decode($header_id)) && $this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
            $header          = $this->repository->getModel();
            $retailerProduct = $this->retailerProductRepository->getModel();

            return view('de.result', compact('rp_id', 'header_id', 'header', 'retailerProduct'));
        }

        return redirect()->back()->with([ 'error_header' => 'La tasa no pudo ser registrada' ]);
    }


    /**
     * Store data for Result Quote
     *
     * @param HeaderResultFormRequest $request
     *
     * @return $this
     */
    public function storeResult(HeaderResultFormRequest $request, $rp_id, $header_id)
    {
        if ($this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
            $retailerProduct = $this->retailerProductRepository->getModel();
            $this->rate      = $retailerProduct->rates()->where('id', $request->get('rate_id'))->first();
        }

        if ($this->rate instanceof Rate) {
            $request['rate'] = $this->rate;

            if ($this->repository->storeResult($request, decode($header_id))) {
                return redirect()->route('de.edit', [
                    'rp_id'     => $rp_id,
                    'header_id' => $header_id,
                ])->with([ 'success_header' => 'La tasa fue registrada correctamente' ]);
            }
        }

        return redirect()->back()->with([ 'error_header' => 'La tasa no pudo ser registrada' ]);
    }


    public function issue($rp_id, $header_id)
    {
        if ($this->repository->issueHeader(decode($header_id))) {
            return redirect()->route('de.issuance', [
                'rp_id'     => $rp_id,
                'header_id' => $header_id,
            ])->with([ 'success_header' => 'La Poliza fue emitida con exito' ]);
        }

        return redirect()->back()->with('error_header', 'La Poliza no puede ser emitida');
    }


    public function issuance($rp_id, $header_id)
    {
        $this->retailerProductRepository->getRetailerProductById(decode($rp_id));
        $rp = $this->retailerProductRepository->getModel();
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header  = $this->repository->getModel();
            $product = null;

            if ($this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
                $product = $this->retailerProductRepository->getModel();
            }

            return view('de.issuance', compact('rp_id', 'header_id', 'header', 'product', 'rp'));

        }

        return redirect()->back();
    }


    public function viSPList($rp_id, $header_id, $sp_id)
    {
        if ($this->repository->getHeaderById(decode($header_id))) {
            $header = $this->repository->getModel();

            return view('vi.sp.list', compact('rp_id', 'header_id', 'header', 'sp_id'));
        }

        return redirect()->back()->with([ 'error_header' => 'El numero de Poliza no existe' ]);
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

        return redirect()->back()->with([ 'error_cache' => 'El Sub-Producto no puede ser procesado' ]);
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


    /**
     * @param $rp_id
     * @param $header_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestCreate($rp_id, $header_id)
    {
        if (request()->ajax()) {
            if ($this->repository->getHeaderById(decode($header_id))) {
                $header = $this->repository->getModel();

                $observation = '';

                foreach ($header->details as $detail) {
                    if ( ! $detail->approved && ( $detail->facultative instanceof Facultative )) {
                        $observation .= $detail->facultative->reason;
                    }
                }

                if ( ! empty( $observation )) {
                    $header->facultative_observation = $observation;

                    $payload = view('de.facultative.request', compact('rp_id', 'header'));

                    return response()->json([
                        'payload'                 => $payload->render(),
                        'facultative_observation' => strip_tags($header->facultative_observation),
                    ]);
                }
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

        return redirect()->back()->with([ 'error_header' => 'La solicitud no puede ser enviada' ]);
    }


    /**
     * @param FacultativeRequestFormRequest $request
     * @param                               $rp_id
     * @param                               $header_id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function requestStore(FacultativeRequestFormRequest $request, $rp_id, $header_id)
    {
        if ($request->ajax()) {
            if ($this->repository->storeFacultative($request, decode($header_id))) {
                $header = $this->repository->getModel();

                $mail = new MailController($request->user());

                $mail->subject  = 'Solicitud de aprobación: Caso Facultativo No. ' . $header->prefix . ' - ' . $header->issue_number;
                $mail->template = 'de.request-approval';

                if ($mail->send(decode($rp_id), [ 'header' => $header ], 'COP')) {
                    $this->repository->storeSent();
                }

                return response()->json([
                    'location' => route('de.edit', compact('rp_id', 'header_id'))
                ]);
            }

            return response()->json([ 'err' => 'Unauthorized action.' ], 401);
        }

        return redirect()->back()->with([ 'error_header' => 'La solicitud no pudo ser enviada' ]);
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
