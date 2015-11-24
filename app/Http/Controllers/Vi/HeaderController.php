<?php

namespace Sibas\Http\Controllers\Vi;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Sibas\Http\Controllers\De\DetailController as DetailDeController;
use Sibas\Http\Controllers\De\HeaderController as HeaderDeController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\De\DetailRepository as DetailDeRepository;
use Sibas\Repositories\De\HeaderRepository as HeaderDeRepository;
use Sibas\Repositories\Vi\HeaderRepository;

class HeaderController extends Controller
{
    /**
     * @var HeaderRepository
     */
    private $repository;

    public function __construct(HeaderRepository $repository)
    {
        $this->repository = $repository;
        $this->headerDe   = new HeaderDeController(new HeaderDeRepository);
        $this->detailDe   = new DetailDeController(new DetailDeRepository);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Show the form for creating a new Sub Product.
     *
     * @param $rp_id
     * @param $header_id
     * @param $sp_id
     * @return RedirectResponse
     */
    public function createSubProduct($rp_id, $header_id, $sp_id)
    {
        $key = 'clients_' . $header_id;

        if (Cache::has($key)) {
            $clients = Cache::get($key);

            if (! is_null($clients)) {
                $clients   = json_decode($clients, true);
                $detail_id = array_shift($clients);

                if (! is_null($detail_id)) {
                    if ($this->headerDe->headerById(decode($header_id)) && $this->detailDe->detailById(decode($detail_id))) {
                        $header = $this->headerDe->getHeader();
                        $detail = $this->detailDe->getDetail();
                        $data   = $this->detailDe->getData();

                        return view('vi.sp.create', compact('rp_id', 'sp_id', 'data', 'header', 'detail'));
                    }
                }
            }
        }

        return redirect()->route('de.issuance', [
            'rp_id'     => $rp_id,
            'header_id' => $header_id,
        ]);
    }

    public function storeSubProduct(Request $request)
    {
        dd($request->all());
    }
}
