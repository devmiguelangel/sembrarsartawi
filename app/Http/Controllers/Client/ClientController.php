<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $this->repository = $repository;
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
        if ($this->repository->getClientByDni($request->get('dni'))) {
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

}
