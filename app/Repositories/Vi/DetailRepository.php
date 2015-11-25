<?php

namespace Sibas\Repositories\Vi;

use Illuminate\Http\Request;
use Sibas\Entities\Vi\Detail;
use Sibas\Repositories\BaseRepository;

class DetailRepository extends BaseRepository
{
    public function storeDetailSubProduct(Request $request, $header_id)
    {
        $this->data = $request->all();
        $detailDe   = $this->data['detail'];

        $this->model = new Detail();

        $this->model->id              = date('U');
        $this->model->op_vi_header_id = $header_id;
        $this->model->op_client_id    = $detailDe->client->id;
        $this->model->currency        = 'BS';
        $this->model->client_code     = $detailDe->client->code;
        $this->model->taker_name      = $this->data['taker_name'];
        $this->model->taker_dni       = $this->data['taker_dni'];

        return $this->saveModel();
    }
}