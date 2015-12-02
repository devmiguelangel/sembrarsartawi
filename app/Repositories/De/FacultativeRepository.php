<?php

namespace Sibas\Repositories\De;

use Illuminate\Http\Request;
use Sibas\Entities\De\Facultative;
use Sibas\Repositories\BaseRepository;

class FacultativeRepository extends BaseRepository
{
    /**
     * @param Request $request
     * @return bool
     */
    public function storeFacultative(Request $request)
    {
        $header          = $request['header'];
        $detail          = $request['detail'];
        $retailerProduct = $request['retailerProduct'];
        $retailer        = $retailerProduct->retailer;

        if ($retailerProduct->facultative) {
            $parameter = $this->getParameter($retailerProduct, $detail->amount, $detail->cumulus);

            if (! is_null($parameter)) {
                $this->model = new Facultative();

                dd($this->model);
            }
        }

        return false;
    }

    private function evaluation($parameter, $detail) {
        switch ($parameter->slug) {
            case 'FC':
                return true;
                break;
            case 'AE':
                
                break;
            case 'FA':
                break;
        }
    }

    private function setFCEvaluation()
    {

    }

    private function setAEEvaluation($detail)
    {
        $response = $this->getEvaluationResponse($detail->response);
        $imc      = $detail->client->imc;

        $reason_imc      = ($response ? 'El Titular no cumple con el IMC' : '');
        $reason_response = ($imc ? 'El Titular no cumple con el cuestionario de salud' : '');
        $reason_cumulus  = '';

        $this->model->op_de_detail_id = $detail->id;
        $this->model->reason          = $reason_imc . '<br>' . $reason_response;
    }

    private function getParameter($retailerProduct, $amount, $cumulus)
    {
        foreach ($retailerProduct->parameters as $parameter) {
            if (($amount >= $parameter->amount_min && $amount <= $parameter->amount_max)
                    || ($cumulus >= $parameter->amount_min && $cumulus <= $parameter->amount_max)) {
                return $parameter;
            }
        }

        return null;
    }


}