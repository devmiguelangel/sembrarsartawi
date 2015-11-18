<?php

namespace Sibas\Repositories\De;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\De\Beneficiary;

class BeneficiaryRepository
{
    private $beneficiary;

    private $data;

    private $errors;

    /**
     * @param Request $request
     * @return bool
     */
    public function storeBeneficiary($request)
    {
        $this->data = $request->all();

        try {
            $this->beneficiary = new Beneficiary();

            $this->beneficiary->id               = date('U');
            $this->beneficiary->op_de_detail_id  = decode($this->data['detail_id']);
            $this->beneficiary->coverage         = 'VI';
            $this->beneficiary->first_name       = $this->data['first_name'];
            $this->beneficiary->last_name        = $this->data['last_name'];
            $this->beneficiary->mother_last_name = $this->data['mother_last_name'];
            $this->beneficiary->dni              = $this->data['dni'];
            $this->beneficiary->extension        = $this->data['extension'];
            $this->beneficiary->relationship     = $this->data['relationship'];

            if ($this->beneficiary->save()) {
                return true;
            }
        } catch(QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }
}