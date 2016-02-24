<?php

namespace Sibas\Http\Controllers\Client;

use Illuminate\Http\Request;
use Sibas\Entities\Client;
use Sibas\Http\Controllers\DataTrait;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;
use Sibas\Repositories\Client\ClientRepository;
use Sibas\Repositories\De\DetailRepository;
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
    /**
     * @var DetailRepository
     */
    protected $detailRepository;

    public function __construct(ClientRepository $repository,
                                RetailerProductRepository $retailerProductRepository,
                                DetailRepository $detailRepository,
                                WsRepository $ws)
    {
        $this->repository                = $repository;
        $this->retailerProductRepository = $retailerProductRepository;
        $this->detailRepository          = $detailRepository;
        $this->ws                        = $ws;
    }

    use DataTrait;

    /**
     * Return Client by search
     *
     * @param Request $request
     * @param $rp_id
     * @param $header_id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request, $rp_id, $header_id)
    {
        ini_set('display_errors', 1);
        $ws = false;

        if ($this->retailerProductRepository->getRetailerProductById(decode($rp_id))) {
            $retailerProduct = $this->retailerProductRepository->getModel();

            $ws = $retailerProduct->ws;
        }

        if ($ws && $this->ws->getCustomer($request->get('dni'))) {
            $result = $this->ws->result;
            $data   = $this->getData($rp_id);

            $client = new Client();
            $client->code                = $result[1];
            $client->last_name           = $result[2];
            $client->mother_last_name    = $result[3];
            $client->married_name        = $result[4];
            $client->first_name          = $result[5];
            $client->gender              = $result[7];
            $client->civil_status        = substr($result[8], 0, 1);
            $client->country             = explode('-', $result[9])[3];
            $client->document_type       = $result[10];
            $client->dni                 = $result[11];
            $client->extension           = $result[12];
            $client->birthdate           = date('Y-m-d', strtotime(str_replace('/', '-', $result[13])));
            $client->phone_number_home   = $result[15];
            $client->phone_number_office = $result[16];
            $client->phone_number_mobile = $result[17];
            $client->email               = $result[18];
            $client->place_residence     = strtolower(str_replace(' ', '-', $result[19]));
            $client->locality            = $result[20];
            $client->home_address        = $result[21];

            foreach ($data['activities'] as $activity) {
                if (array_key_exists('code', $activity) && $activity['code'] == $result[22]) {
                    $client->ad_activity_id = $activity['id'];
                }
            }

            $client->occupation_description = $result[24];
            $client->debit_balance          = empty($result[25]) ? '' : str_replace(',', '.', $result[25]);

            return redirect()
                ->route('de.detail.create', compact('rp_id', 'header_id'))
                ->with(['client' => $client]);
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

}
