<?php

namespace Sibas\Http\Controllers\Td;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Controllers\ReportTrait;
use Sibas\Repositories\Td\PreApprovedRepository;

class PreApprovedController extends Controller
{

    use ReportTrait;

    /**
     * @var PreApprovedRepository
     */
    protected $repository;


    public function __construct(PreApprovedRepository $repository)
    {
        $this->repository = $repository;
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
