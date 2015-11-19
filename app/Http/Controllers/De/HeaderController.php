<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Sibas\Entities\Rate;
use Sibas\Http\Controllers\BaseController;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\De\HeaderDeCreateFormRequest;
use Sibas\Http\Requests\De\HeaderDeEditFormRequest;
use Sibas\Http\Requests\De\HeaderResultFormRequest;
use Sibas\Repositories\De\CoverageRepository;
use Sibas\Repositories\De\DataRepository;
use Sibas\Repositories\De\HeaderRepository;


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
    private $repository;
    /**
     * @var Rate
     */
    private $rate;

    public function __construct(HeaderRepository $repository)
    {
        $this->repository = $repository;
        $this->base       = new BaseController(new DataRepository);
        $this->coverage   = new CoverageController(new CoverageRepository);
    }

    private function getData()
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
     * @param HeaderDeCreateFormRequest $request
     * @return Response
     */
    public function store(HeaderDeCreateFormRequest $request)
    {
        if ($this->repository->createHeader($request)) {
            $header = $this->repository->getModel();

            return redirect()->route('de.client.list', [
                'rp_id'     => decrypt($request->get('rp_id')),
                'header_id' => encode($header->id),
            ]);
        }

        return redirect()->back()->withInput()->withErrors($this->repository->getErrors());
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
        if ($this->repository->getHeaderById(decode($header_id))) {
            $data   = $this->getData();
            $header = $this->getHeader();

            return view('de.edit', compact('rp_id', 'header_id', 'header', 'data'));
        }

        return redirect()->route('de.edit', [
            'rp_id'     => decrypt($rp_id),
            'header_id' => $header_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HeaderDeEditFormRequest $request
     * @return Response
     */
    public function update(HeaderDeEditFormRequest $request)
    {
        if ($this->repository->updateHeader($request)) {
            return redirect()->route('de.edit', [
                'rp_id'     => decrypt($request->get('rp_id')),
                'header_id' => $request->get('header_id'),
            ]);
        }

        return redirect()->back()->withInput()->withErrors($this->repository->getErrors());
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
            ]);
        }

        return redirect()->back()->with(['err_result' => 'La tasa no fue registrada']);
    }

    public function issue($rp_id, $header_id)
    {
        if ($this->repository->issueHeader($header_id)) {
            return redirect()->route('de.issuance', [
                'rp_id'     => $rp_id,
                'header_id' => $header_id,
            ]);
        }

        return redirect()->back()->with('issuance', 'La Poliza no puede ser emitida');
    }

    public function issuance($rp_id, $header_id)
    {
        $header = $this->repository->getHeaderById(decode($header_id));

        return view('de.issuance', compact('rp_id', 'header_id', 'header'));
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
