<?php

namespace Sibas\Repositories\De;

use Illuminate\Http\Request;
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

        if ($retailerProduct->facultative) {
            dd($header->amount_requested);
        }

        $response = $this->getEvaluationResponse($detail->response);
        $imc      = $detail->client->imc;

        if ($response || $imc) {

        }

        return false;
    }
}