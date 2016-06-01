<?php

namespace Sibas\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\De\FacultativeRepository as FacultativeDeRepository;
use Sibas\Repositories\Au\FacultativeRepository as FacultativeAuRepository;
use Sibas\Repositories\Td\FacultativeRepository as FacultativeTdRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;

class HomeController extends Controller
{

    /**
     * @var string
     */
    protected $inbox;

    /**
     * @var int
     */
    protected $header_id;

    /**
     * @var FacultativeDeRepository
     */
    protected $facultativeDeRepository;

    /**
     * @var RetailerProductRepository
     */
    protected $retailerProductRepository;

    /**
     * @var FacultativeAuRepository
     */
    protected $facultativeAuRepository;
    
    /**
     * @var FacultativeTdRepository
     */
    protected $facultativeTdRepository;

    public function __construct(
        FacultativeDeRepository $facultativeDeRepository,
        FacultativeAuRepository $facultativeAuRepository,
        FacultativeTdRepository $facultativeTdRepository,
        RetailerProductRepository $retailerProductRepository
    ) {
        $this->facultativeDeRepository   = $facultativeDeRepository;
        $this->retailerProductRepository = $retailerProductRepository;

        $this->inbox                   = 'all';
        $this->header_id               = null;
        $this->facultativeAuRepository = $facultativeAuRepository;
        $this->facultativeTdRepository = $facultativeTdRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Guard $auth
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Guard $auth)
    {
        $arp_id = null;

        if (request()->has('inbox') && in_array(request()->get('inbox'), config('base.inbox'))) {
            $this->inbox = request()->get('inbox');
        }

        if (request()->has('arp')) {
            $arp_id = decode(request()->get('arp'));
        }

        if (request()->has('odh')) {
            $this->header_id = decode(request()->get('odh'));
        }

        $user = $auth->user();

        $data = [
            'products' => [ ],
        ];

        if ($user->profile->first()->slug === 'SEP' || $user->profile->first()->slug === 'COP') {
            /*if ( ! is_null($arp_id)) {
                if ($this->retailerProductRepository->getRetailerProductById($arp_id)) {
                    $retailerProduct = $this->retailerProductRepository->getModel();

                    $this->setData($retailerProduct, $user, $data);
                }
            }*/
            foreach ($user->retailer->first()->retailerProducts as $retailerProduct) {
                $this->setData($retailerProduct, $user, $data);
            }
        }

        return view('home', compact('user', 'data'));
    }


    private function setData($retailerProduct, $user, &$data)
    {
        if ($retailerProduct->type === 'MP' && $retailerProduct->facultative) {
            $product     = $retailerProduct->companyProduct->product;
            $product->rp = $retailerProduct;

            switch ($product->code) {
                case 'de':
                    $product->records = $this->facultativeDeRepository->getRecords($user, $this->inbox,
                        $this->header_id);
                    break;
                case 'au':
                    $product->records = $this->facultativeAuRepository->getRecords($user, $this->inbox,
                        $this->header_id);
                    break;
                case 'td':
                    $product->records = $this->facultativeTdRepository->getRecords($user, $this->inbox,
                        $this->header_id);
                    break;
            }

            array_push($data['products'], $product);
        }
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
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
