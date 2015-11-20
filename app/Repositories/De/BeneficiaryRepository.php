<?php

namespace Sibas\Repositories\De;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\De\Beneficiary;
use Sibas\Repositories\BaseRepository;

class BeneficiaryRepository extends BaseRepository
{
    /**
     * @param Request $request
     * @param int $detail_id
     * @return bool
     */
    public function storeBeneficiary($request, $detail_id)
    {
        $this->data = $request->all();

        $this->model = new Beneficiary();

        $this->model->id               = date('U');
        $this->model->op_de_detail_id  = $detail_id;
        $this->model->coverage         = 'VI';
        $this->model->first_name       = $this->data['first_name'];
        $this->model->last_name        = $this->data['last_name'];
        $this->model->mother_last_name = $this->data['mother_last_name'];
        $this->model->dni              = $this->data['dni'];
        $this->model->extension        = $this->data['extension'];
        $this->model->relationship     = $this->data['relationship'];

        return $this->saveModel();
    }
}