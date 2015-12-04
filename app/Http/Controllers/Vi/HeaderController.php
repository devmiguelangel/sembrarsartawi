<?php

namespace Sibas\Http\Controllers\Vi;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Sibas\Http\Controllers\BaseController;
use Sibas\Http\Controllers\Client\AccountController;
use Sibas\Http\Controllers\Client\ClientController;
use Sibas\Http\Controllers\De\DetailController as DetailDeController;
use Sibas\Http\Controllers\De\HeaderController as HeaderDeController;
use Sibas\Http\Controllers\Retailer\RetailerProductController;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Vi\HeaderSpCreateFormRequest;
use Sibas\Repositories\Client\AccountRepository;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\De\DataRepository;
use Sibas\Repositories\De\DetailRepository as DetailDeRepository;
use Sibas\Repositories\De\HeaderRepository as HeaderDeRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;
use Sibas\Repositories\Vi\DetailRepository;
use Sibas\Repositories\Vi\HeaderRepository;

class HeaderController extends Controller
{
    /**
     * @var HeaderRepository
     */
    private $repository;
    /**
     * @var HeaderDeController
     */
    private $headerDe;
    /**
     * @var DetailDeController
     */
    private $detailDe;
    /**
     * @var ClientController
     */
    private $client;
    /**
     * @var RetailerProductController
     */
    private $retailerProduct;
    /**
     * @var BaseController
     */
    private $base;
    /**
     * @var DetailController
     */
    private $detail;
    /**
     * @var AccountController
     */
    private $account;

    public function __construct(HeaderRepository $repository)
    {
        $this->repository      = $repository;
        $this->base            = new BaseController(new DataRepository);
        $this->headerDe        = new HeaderDeController(new HeaderDeRepository);
        $this->detailDe        = new DetailDeController(new DetailDeRepository);
        $this->client          = new ClientController(new ClientRepository);
        $this->retailerProduct = new RetailerProductController(new RetailerProductRepository);

        $this->detail          = new DetailController(new DetailRepository);
        $this->account         = new AccountController(new AccountRepository);
    }

    public function getData()
    {
        return [
            'payment_methods' => $this->base->getPaymentMethod(),
            'periods'         => $this->base->getPeriod(),
        ];
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
                        $data   = $this->getData();
                        $data   = array_merge($data, $this->client->getData());
                        $data['questions'] = $this->retailerProduct->questionByProduct($sp_id);
                        $data['plans']     = $this->retailerProduct->plans($sp_id);

                        return view('vi.sp.create', compact('rp_id', 'header_id', 'sp_id', 'data', 'header', 'detail'));
                    }
                }
            }
        }

        return redirect()->route('de.issuance', [
            'rp_id'     => $rp_id,
            'header_id' => $header_id,
        ])->with(['error_header' => 'La Poliza de Vida no puede ser creada']);
    }

    public function storeSubProduct(HeaderSpCreateFormRequest $request)
    {
        $key            = 'clients_' . $request->get('header_id');
        $success_header = ['success_header' => 'El Sub-Producto fue asociado correctamente'];

        if ($this->headerDe->headerById(decode($request->get('header_id')))
                && $this->detailDe->detailById(decode($request->get('detail_id')))) {
            $headerDe = $this->headerDe->getHeader();
            $detailDe = $this->detailDe->getDetail();

            $request['header']   = $headerDe;
            $request['detail']   = $detailDe;
            $request['policies'] = $this->retailerProduct->policies($request->get('sp_id'));
            $request['plans']    = $this->retailerProduct->plans($request->get('sp_id'));

            if ($this->repository->storeHeaderSubProduct($request)) {
                $header = $this->repository->getModel();

                if ($this->detail->storeDetailSubProduct($request, $header->id) && $this->account->store($request)) {
                    if ($this->repository->destroyClientCacheSP($request->get('header_id'), $request->get('detail_id'))) {
                        return redirect()->route('de.vi.sp.create', [
                            'rp_id'     => decrypt($request->get('rp_id')),
                            'header_id' => $request->get('header_id'),
                            'sp_id'     => $request->get('sp_id'),
                        ])->with($success_header);
                    } else {
                        return redirect()->route('de.issuance', [
                            'rp_id'     => decrypt($request->get('rp_id')),
                            'header_id' => $request->get('header_id'),
                        ])->with($success_header);
                    }
                }
            }
        }

        return redirect()->back()
            ->with(['error_header' => 'El Sub-Producto no puede ser asociado al Titular'])
            ->withInput()->withErrors($this->repository->getErrors());
    }
}
