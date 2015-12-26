<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Sibas\Entities\Client;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\Client\ClientRepository;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    protected $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository         = $repository;
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
    public function search(Request $request)
    {
        if ($this->repository->getClientByDni($request->get('dni'))) {
            $rp_id     = decrypt($request->get('rp_id'));
            $header_id = $request->get('header_id');

            $client    = $this->repository->getModel();
            $client_id = encode($client->id);

            return redirect()->route('de.detail.create', compact('rp_id', 'header_id', 'client_id'));
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

    /**
     * Returns Client
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getClient()
    {
        return $this->repository->getModel();
    }

}
