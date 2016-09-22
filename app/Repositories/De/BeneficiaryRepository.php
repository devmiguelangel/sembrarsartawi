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
     *
     * @return bool
     */
    public function storeBeneficiary($request)
    {
        $this->data  = $request->all();
        $this->model = $this->data['detail'];

        $this->data['beneficiary_id'] = date('U');

        try {
            $this->model->beneficiaries()->create($this->setData());
        } catch (QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return $this->saveModel();
    }


    /**
     * @param Request $request
     *
     * @return bool
     */
    public function updateBeneficiary($request)
    {
        $this->data  = $request->all();
        $this->model = $this->data['detail'];

        try {
            $this->model->beneficiaries()->where('id', $this->data['beneficiary_id'])->update($this->setData());
        } catch (QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return $this->saveModel();
    }


    public function getBeneficiaryById($beneficiary_id)
    {
        $this->model = Beneficiary::where('id', $beneficiary_id)->first();

        if ( ! is_null($this->model)) {
            return true;
        }

        return false;
    }


    private function setData()
    {
        $data = [
            'id'               => $this->data['beneficiary_id'],
            'coverage'         => $this->data['type'],
            'first_name'       => mb_strtoupper($this->data['first_name']),
            'last_name'        => mb_strtoupper($this->data['last_name']),
            'mother_last_name' => mb_strtoupper($this->data['mother_last_name']),
            'relationship'     => mb_strtoupper($this->data['relationship']),
        ];

        if ($this->data['type'] === 'SP') {
            $data['dni']       = mb_strtoupper($this->data['dni']);
            $data['extension'] = mb_strtoupper($this->data['extension']);
        } elseif ($this->data['type'] === 'VI' || $this->data['type'] === 'CO') {
            $data['age'] = $this->data['age'];
        }

        return $data;
    }
}