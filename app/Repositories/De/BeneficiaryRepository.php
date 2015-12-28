<?php

namespace Sibas\Repositories\De;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\De\Beneficiary;
use Sibas\Repositories\BaseRepository;

class BeneficiaryRepository extends BaseRepository
{
    /**
     * Store Beneficiary
     *
     * @param Request $request
     * @return bool
     */
    public function storeBeneficiary($request)
    {
        $this->data = $request->all();
        $detail     = $this->data['detail'];

        $this->model = new Beneficiary([
            'id'       => date('U'),
            'coverage' => 'VI',
        ]);

        $this->setData();

        try {
            if ($detail->beneficiary()->save($this->model)) {
                return true;
            }
        } catch(QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function updateBeneficiary($request)
    {
        $this->data = $request->all();
        $detail     = $this->data['detail'];

        if ($this->getBeneficiaryById(decode($this->data['beneficiary_id']))) {
            $beneficiary = $this->getModel();
            $this->setData();

            try {
                if ($detail->beneficiary()->update($beneficiary->toArray())) {
                    return true;
                }
            } catch(QueryException $e) {
                $this->errors = $e->getMessage();
            }
        }

        return false;
    }

    public function getBeneficiaryById($beneficiary_id)
    {
        $this->model = Beneficiary::where('id', $beneficiary_id)->first();

        if (! is_null($this->model)) {
            return true;
        }

        return false;
    }

    private function setData()
    {
        $this->model->first_name       = $this->data['first_name'];
        $this->model->last_name        = $this->data['last_name'];
        $this->model->mother_last_name = $this->data['mother_last_name'];
        $this->model->dni              = $this->data['dni'];
        $this->model->extension        = $this->data['extension'];
        $this->model->relationship     = $this->data['relationship'];
    }
}