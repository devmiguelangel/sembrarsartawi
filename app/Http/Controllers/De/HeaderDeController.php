<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Http\Request;
use Sibas\Http\Controllers\BaseController;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\De\HeaderDeCreateFormRequest;
use Sibas\Repositories\De\CoverageRepository;
use Sibas\Repositories\De\DataRepository;
use Sibas\Repositories\De\HeaderDeRepository;


class HeaderDeController extends Controller
{
    protected $data;
    protected $coverage;
    /**
     * @var HeaderDeRepository
     */
    private $repository;

    public function __construct(HeaderDeRepository $repository)
    {
        $this->data       = new BaseController(new DataRepository);
        $this->coverage   = new CoverageController(new CoverageRepository);
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param String $rp_id
     * @return \Illuminate\Http\Response
     */
    public function create($rp_id)
    {
        $coverages  = $this->coverage->index();
        $currencies = $this->data->currency();
        $term_types = $this->data->termType();

        return view('de.create', compact('rp_id', 'coverages', 'currencies', 'term_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|HeaderDeCreateFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HeaderDeCreateFormRequest $request)
    {
        if ($this->repository->saveQuote($request)) {
            return redirect()
                ->route('de.client.list', [
                    'rp_id'     => decrypt($request->get('rp_id')),
                    'header_id' => encode($this->repository->getId()),
                ])
                ->with('header_id', encode($this->repository->getId()));
        }

        return redirect()->back()->withInput()->withErrors($this->repository->getErrors());
    }

    public function result($rp_id, $header_id)
    {
        $retailer = request()->user()->retailer->first();

        return view('de.result', compact('rp_id', 'retailer'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function headerById($header_id)
    {
        return $this->repository->getHeaderById($header_id);
    }

    public function headerTypeById($id)
    {
        return $this->repository->getHeaderTypeById($id);
    }
}
