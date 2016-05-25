<?php

namespace Sibas\Http\Controllers\Td;

use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use Sibas\Http\Controllers\MailController;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Controllers\ReportTrait;
use Sibas\Repositories\Td\CancellationRepository;
use Sibas\Repositories\Td\HeaderRepository;

class CancellationController extends Controller
{

    use ReportTrait;

    /**
     * @var CancellationRepository
     */
    protected $repository;

    /**
     * @var HeaderRepository
     */
    protected $headerRepository;


    /**
     * CancellationController constructor.
     *
     * @param CancellationRepository $repository
     * @param HeaderRepository       $headerRepository
     */
    public function __construct(
        CancellationRepository $repository,
        HeaderRepository $headerRepository
    ) {
        $this->repository       = $repository;
        $this->headerRepository = $headerRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Guard   $auth
     * @param Request $request
     * @param string  $rp_id
     *
     * @return \Illuminate\Http\Response
     */
    public function lists(Guard $auth, Request $request, $rp_id)
    {
     
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param string $rp_id
     * @param string $header_id
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rp_id, $header_id)
    {
      
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param string                    $rp_id
     * @param string                    $header_id
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $rp_id, $header_id)
    {
        
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

}
