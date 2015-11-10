<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Http\Request;
use Sibas\Http\Controllers\BaseController;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Controllers\UserController;
use Sibas\Http\Requests\De\HeaderCreateFormRequest;
use Sibas\Repositories\De\CoverageRepository;
use Sibas\Repositories\De\DataRepository;
use Sibas\Repositories\De\HeaderRepository;


class HeaderController extends Controller
{
    protected $data;
    protected $coverage;
    /**
     * @var HeaderRepository
     */
    private $repository;

    public function __construct(HeaderRepository $repository)
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coverages  = $this->coverage->index();
        $currencies = $this->data->currency();
        $term_types = $this->data->termType();

        return view('de.create', compact('coverages', 'currencies', 'term_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request|HeaderCreateFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HeaderCreateFormRequest $request)
    {
        if ($this->repository->saveQuote($request)) {
            return redirect()
                ->route('de.client.create', ['id' => base64_encode($this->repository->id)])
                ->with('header_id', $this->repository->id);
        }

        return redirect()->back()->withInput()->withErrors($this->repository->errors);
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
}
