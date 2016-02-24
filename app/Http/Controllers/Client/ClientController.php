<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\Retailer\RetailerProductRepository;
use Sibas\Repositories\WsRepository;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    protected $repository;
    /**
     * @var RetailerProductRepository
     */
    protected $retailerProductRepository;
    /**
     * @var WsRepository
     */
    protected $ws;

    public function __construct(ClientRepository $repository,
                                RetailerProductRepository $retailerProductRepository,
                                WsRepository $ws)
    {
        $this->repository                = $repository;
        $this->retailerProductRepository = $retailerProductRepository;
        $this->ws = $ws;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Return Client by search
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request, $rp_id, $header_id)
    {
        $ws = false;

        if ($this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
            $retailerProduct = $this->retailerProductRepository->getModel();

            $ws = $retailerProduct->ws;
        }

        if ($ws) {

        } else {
            if ($this->repository->getClientByDni($request->get('dni'))) {
                $client    = $this->repository->getModel();
                $client_id = encode($client->id);

                return redirect()->route('de.detail.create', compact('rp_id', 'header_id', 'client_id'));
            }
        }

        return redirect()->back()
            ->with(['error_client' => 'El Cliente no existe'])
            ->withInput()->withErrors($this->repository->getErrors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
