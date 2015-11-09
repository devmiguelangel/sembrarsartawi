<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Http\Request;
use Sibas\Http\Controllers\BaseController;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\De\HeaderCreateFormRequest;
use Sibas\Repositories\De\CoverageRepository;
use Sibas\Repositories\De\DataRepository;

class HeaderController extends Controller
{
    protected $data;
    protected $coverage;

    public function __construct()
    {
        $this->data     = new BaseController(new DataRepository());
        $this->coverage = new CoverageController(new CoverageRepository);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(HeaderCreateFormRequest $request)
    {
        dd($request->user());
        dd($request->all());
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
