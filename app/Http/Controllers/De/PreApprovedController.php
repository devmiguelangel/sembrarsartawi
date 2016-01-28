<?php

namespace Sibas\Http\Controllers\De;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Controllers\ReportTrait;
use Sibas\Repositories\De\HeaderRepository;
use Sibas\Repositories\De\PreApprovedRepository;

class PreApprovedController extends Controller
{
    use ReportTrait;
    /**
     * @var PreApprovedRepository
     */
    protected $repository;
    /**
     * @var HeaderRepository
     */
    protected $headerRepository;

    public function __construct(PreApprovedRepository $repository,
                                HeaderRepository $headerRepository)
    {
        $this->repository       = $repository;
        $this->headerRepository = $headerRepository;
    }

    public function lists(Guard $auth, Request $request, $rp_id)
    {
        $data    = $this->data($auth->user());
        $headers = [];

        if ($request->has('_token')) {
            $request->flash();

            $headers = $this->repository->getHeaderList($request);
        }

        return view('de.pre-approved.list', compact('rp_id', 'headers', 'data'));
    }
}
