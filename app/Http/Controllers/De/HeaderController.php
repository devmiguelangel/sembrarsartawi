<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Sibas\Entities\Rate;
use Sibas\Http\Controllers\BaseController;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Controllers\Retailer\RetailerProductController;
use Sibas\Http\Requests\De\HeaderCreateFormRequest;
use Sibas\Http\Requests\De\HeaderEditFormRequest;
use Sibas\Http\Requests\De\HeaderResultFormRequest;
use Sibas\Repositories\De\CoverageRepository;
use Sibas\Repositories\De\DataRepository;
use Sibas\Repositories\De\HeaderRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;


class HeaderController extends Controller
{
    /**
     * @var BaseController
     */
    protected $base;
    /**
     * @var CoverageController
     */
    protected $coverage;
    /**
     * @var HeaderRepository
     */
    protected $repository;
    /**
     * @var Rate
     */
    private $rate;
    /**
     * @var RetailerProductController
     */
    private $retailerProduct;

    public function __construct(HeaderRepository $repository)
    {
        $this->repository      = $repository;
        $this->base            = new BaseController(new DataRepository);
        $this->coverage        = new CoverageController(new CoverageRepository);
        $this->retailerProduct = new RetailerProductController(new RetailerProductRepository);
    }

    /**
     * Returns data for create Header
     *
     * @return array
     */
    public function getData()
    {
        return [
            'coverages'  => $this->coverage->coverage(),
            'currencies' => $this->base->currency(),
            'term_types' => $this->base->termType(),
        ];
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
     * @param String $rp_id
     * @return Response
     */
    public function create($rp_id)
    {
        $data = $this->getData();

        return view('de.create', compact('rp_id', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HeaderCreateFormRequest $request
     * @return Response
     */
    public function store(HeaderCreateFormRequest $request)
    {
        if ($this->repository->createHeader($request)) {
            $header = $this->repository->getModel();

            return redirect()->route('de.client.list', [
                'rp_id'     => decrypt($request->get('rp_id')),
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
            $data   = $this->getData();
            $header = $this->getHeader();

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
    public function update(HeaderEditFormRequest $request)
    {
        if ($this->repository->updateHeader($request)) {
            return redirect()->route('de.edit', [
                'rp_id'     => decrypt($request->get('rp_id')),
                'header_id' => $request->get('header_id'),
            ])->with(['success_header' => 'La Póliza fue actualizada con éxito.']);
        }

        return redirect()->back()
            ->with(['error_header' => 'La Póliza no pudo ser registrada.'])
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
    public function storeResult(HeaderResultFormRequest $request)
    {
        $this->rate = Rate::where('id', $request->get('rate_id'))->first();
        $request['rate'] = $this->rate;

        if ($this->repository->storeResult($request)) {
            return redirect()->route('de.edit', [
                'rp_id'     => decrypt($request->get('rp_id')),
                'header_id' => $request->get('header_id'),
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

            $subProducts = $this->retailerProduct->subProductByIdProduct($rp_id);

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

    /** Find Header by Id
     *
     * @param $header_id
     * @return bool
     */
    public function headerById($header_id)
    {
        return $this->repository->getHeaderById($header_id);
    }

    /**
     * @return Model
     */
    public function getHeader(){
        return $this->repository->getModel();
    }
}
