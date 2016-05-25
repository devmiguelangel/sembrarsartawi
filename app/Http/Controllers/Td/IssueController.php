<?php

namespace Sibas\Http\Controllers\Td;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Sibas\Entities\ProductParameter;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Controllers\ReportTrait;
use Sibas\Repositories\Td\IssueRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;

class IssueController extends Controller
{

    use ReportTrait;

    /**
     * @var IssueRepository
     */
    protected $repository;

    /**
     * @var RetailerProductRepository
     */
    protected $retailerProductRepository;


    public function __construct(
        IssueRepository $repository,
        RetailerProductRepository $retailerProductRepository
    ) {
        $this->repository                = $repository;
        $this->retailerProductRepository = $retailerProductRepository;
    }


    /**
     * @param Guard   $auth
     * @param Request $request
     * @param string  $rp_id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lists(Guard $auth, Request $request, $rp_id)
    {
       
    }
}
