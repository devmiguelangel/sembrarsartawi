<?php

namespace Sibas\Repositories\De;

use Illuminate\Http\Request;
use Sibas\Entities\De\Facultative;
use Sibas\Entities\ProductParameter;
use Sibas\Repositories\BaseRepository;

class FacultativeRepository extends BaseRepository
{
    /**
     * @var ProductParameter
     */
    private $parameter = null;
    /**
     * @param Request $request
     * @return bool
     */
    public function storeFacultative(Request $request, $rp_id)
    {
        $header          = $request['header'];
        $detail          = $request['detail'];
        $retailer        = $request['retailer'];
        $retailerProduct = $retailer->retailerProducts()->where('id', $rp_id)->first();

        if ($retailerProduct->facultative) {
            $this->getParameter($retailerProduct, $detail->amount, $detail->cumulus);

            if ($this->getFacultativeByDetail($detail->id)) {
                $this->model = $this->getModel();
            }

            if ($this->evaluation($detail)) {
                return $this->saveModel();
            }
        }

        return false;
    }

    private function evaluation($detail) {
        if ($this->parameter instanceof ProductParameter) {
            switch ($this->parameter->slug) {
                case 'FC':

                    break;
                case 'AE':
                    return $this->setAeEvaluation($detail);
                    break;
                case 'FA':
                    return $this->setAeEvaluation($detail);
                    break;
            }
        }

        return false;
    }

    private function setAeEvaluation($detail)
    {
        $response = $this->getEvaluationResponse($detail->response);
        $imc      = $detail->client->imc;

        $reason   = '';

        if ($imc) {
            $reason .= str_replace([':name'], [$detail->client->full_name], $this->reasonImc) . '<br>';
        }

        if ($response) {
            $reason .= str_replace([':name'], [$detail->client->full_name], $this->reasonResponse) . '<br>';
        }

        if ($this->parameter->slug == 'FA') {
            $reason .= str_replace([':name', ':cumulus', ':amount_max'], [
                    $detail->client->full_name,
                    number_format($detail->cumulus, 2),
                    number_format(($this->parameter->amount_min - 1), 2)
                ], $this->reasonCumulus) . '<br>';
        }

        $this->model->op_de_detail_id = $detail->id;
        $this->model->state           = 'PE';
        $this->model->reason          = $reason;

        return true;
    }

    private function getParameter($retailerProduct, $amount, $cumulus)
    {
        foreach ($retailerProduct->parameters as $parameter) {
            if (($amount >= $parameter->amount_min && $amount <= $parameter->amount_max)
                    || ($cumulus >= $parameter->amount_min && $cumulus <= $parameter->amount_max)) {
                $this->parameter = $parameter;
            }
        }
    }

    public function getFacultativeByDetail($detail_id)
    {
        $this->model = Facultative::where('op_de_detail_id', $detail_id)->get();

        if ($this->model->count() === 1) {
            $this->model = $this->model->first();

            return true;
        } else {
            $this->model     = new Facultative();
            $this->model->id = date('U');
        }

        return false;
    }

}