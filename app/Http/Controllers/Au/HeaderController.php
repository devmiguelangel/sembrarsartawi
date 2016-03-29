<?php

namespace Sibas\Http\Controllers\Au;

use Sibas\Http\Controllers\DataTrait;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Http\Requests\Au\HeaderCreateFormRequest;
use Sibas\Repositories\Au\HeaderRepository;
use Sibas\Repositories\Client\ClientRepository;

class HeaderController extends Controller
{

    /**
     * @var ClientRepository
     */
    protected $clientRepository;

    /**
     * @var HeaderRepository
     */
    protected $repository;


    public function __construct(HeaderRepository $repository, ClientRepository $clientRepository)
    {
        $this->repository       = $repository;
        $this->clientRepository = $clientRepository;
    }


    use DataTrait;


    /**
     *
     * Show the form for creating a new resource.
     *
     * @param string $rp_id
     *
     * @return mixed
     */
    public function create($rp_id)
    {
        $data = $this->getData($rp_id);

        return view('au.create', compact('rp_id', 'data'));
    }


    /**
     *
     *  Store a newly created resource in storage.
     *
     * @param HeaderCreateFormRequest $request
     * @param string                  $rp_id
     *
     * @return mixed
     */
    public function store(HeaderCreateFormRequest $request, $rp_id)
    {
        if ($this->clientRepository->createClient($request)) {
            $client = $this->clientRepository->getModel();

            if ($this->repository->storeHeader($request, $client)) {
                $header = $this->repository->getModel();

                return redirect()->route('au.vh.create', [
                    'rp_id'     => $rp_id,
                    'header_id' => encode($header->id),
                ])->with([ 'success_header' => 'La cotización fue registrada con éxito.' ]);
            }
        }

        return redirect()->back()->with([ 'error_header' => 'El Cliente no pudo ser registrado' ])->withInput()->withErrors($this->repository->getErrors());
    }
}
