<?php

namespace Sibas\Repositories\Au;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Sibas\Entities\Client;
use Sibas\Entities\Au\Header;
use Sibas\Repositories\BaseRepository;

class HeaderRepository extends BaseRepository
{

    /**
     *
     * Store Header AU
     *
     * @param Request      $request
     * @param Model|Client $client
     *
     * @return bool
     */
    public function storeHeader($request, $client)
    {
        $this->data = $request->all();

        $this->model  = new Header();
        $quote_number = $this->getNumber('Q');

        $date = $this->carbon->createFromTimestamp(strtotime(str_replace('/', '-', $this->data['validity_start'])));

        $this->model->id             = date('U');
        $this->model->ad_user_id     = $request->user()->id;
        $this->model->op_client_id   = $client->id;
        $this->model->type           = 'Q';
        $this->model->quote_number   = $quote_number;
        $this->model->warranty       = (boolean) $this->data['warranty'];
        $this->model->validity_start = $date->format('Y-m-d');
        $this->model->validity_end   = $date->addYear(1)->format('Y-m-d');
        $this->model->payment_method = $this->data['payment_method'];
        $this->model->currency       = $this->data['currency'];
        $this->model->term           = $this->data['term'];
        $this->model->type_term      = $this->data['type_term'];

        if ( ! $this->checkNumber('Q', $quote_number)) {
            return $this->saveModel();
        }

        return false;
    }
}