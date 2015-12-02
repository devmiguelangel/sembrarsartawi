<?php

namespace Sibas\Repositories\De;

use Illuminate\Http\Request;
use Sibas\Entities\Client;
use Sibas\Entities\De\Detail;
use Sibas\Entities\De\Header;
use Sibas\Entities\De\Response;
use Sibas\Entities\RetailerProduct;
use Sibas\Repositories\BaseRepository;

class DetailRepository extends BaseRepository
{
    /**
     * @var Header
     */
    private $header;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var RetailerProduct
     */
    private $retailerProduct;

    /** Create a newly created Detail.
     *
     * @param Request $request
     * @return bool
     */
    public function createDetail($request)
    {
        $this->data            = $request->all();
        $this->header          = $this->data['header'];
        $this->client          = $this->data['client'];
        $this->retailerProduct = $this->data['retailerProduct'];

        $retailer = $this->retailerProduct->retailer;

        $this->model= new Detail();

        $amount = $this->getAmountInBs($this->header->currency,
                                        $this->header->amount_requested,
                                        $retailer->exchangeRate->bs_value);

        $this->model->id                = date('U');
        $this->model->op_de_header_id   = $this->header->id;
        $this->model->op_client_id      = $this->client->id;
        $this->model->percentage_credit = $this->getPercentage();
        $this->model->rate              = 0;
        $this->model->balance           = 0;
        $this->model->cumulus           = 0;
        $this->model->amount            = $amount;
        $this->model->approved          = false;
        $this->model->headline          = $this->getHeadlineType();

        return $this->saveModel();
    }

    public function updateBalance(Request $request, $detail_id)
    {
        $this->data  = $request->all();
        $header      = $this->data['header'];

        if ($this->getDetailById($detail_id)) {
            if ($this->data['amount_requested'] == $header->amount_requested) {
                $cumulus = $this->model->amount + $this->data['balance'];

                $this->model->balance = $this->data['balance'];
                $this->model->cumulus = $cumulus;

                return $this->saveModel();
            }
        }

        return false;
    }

    public function getDetailById($detail_id)
    {
        $this->model = Detail::where('id', $detail_id)->get();

        if ($this->model->count() === 1) {
            $this->model = $this->model->first();

            return true;
        }

        return false;
    }

    /** Returns Headline Type for Client
     *
     * @return string
     */
    public function getHeadlineType()
    {
        if ($this->header->coverage->slug === 'MC') {
            $details = Detail::where('op_de_header_id', $this->header->id)->count();

            if ($details === 1) {
                return 'C';
            }
        }

        return 'D';
    }

    /** Returns Percentage Credit for Client
     *
     * @return int
     */
    private function getPercentage()
    {
        $percentage = 0;

        switch ($this->header->coverage->slug) {
            case 'IC':
                $percentage = 100;
                break;
            case 'MC':
                $percentage = 50;
                break;
            case 'BC':
                $percentage = 10;
                break;
        }

        return $percentage;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}