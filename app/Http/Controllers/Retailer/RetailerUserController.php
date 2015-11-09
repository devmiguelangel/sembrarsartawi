<?php

namespace Sibas\Http\Controllers\Retailer;

use Illuminate\Http\Request;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\Retailer\RetailerUserRepository;

class RetailerUserController extends Controller
{
    /**
     * @var RetailerUserRepository
     */
    private $repository;
    /**
     * @var \Sibas\Entities\User
     */
    private $user;

    /**
     * @param \Sibas\Entities\User $user
     * @param RetailerUserRepository $repository
     */
    public function __construct($user, RetailerUserRepository $repository)
    {
        $this->user       = $user;
        $this->repository = $repository;
    }

    public function detailForUser()
    {
        return $this->repository->getDetailForUser($this->user);
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
}
