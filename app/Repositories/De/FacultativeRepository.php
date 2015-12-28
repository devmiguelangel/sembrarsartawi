<?php

namespace Sibas\Repositories\De;

use Illuminate\Database\QueryException;
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
     * @var array
     */
    protected $props = [
        'reason' => '',
        'state'  => '',
    ];

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

            $evaluation = $this->evaluation($detail);

            try {
                if ($detail->facultative instanceof Facultative) {
                    if ($evaluation) {
                        $detail->facultative()->update($this->props);

                        return true;
                    } else {
                        $detail->facultative()->delete();
                    }
                } else if ($evaluation) {
                    $detail->facultative()->create([
                        'id'     => date('U'),
                        'reason' => $this->props['reason'],
                        'state'  => $this->props['state'],
                    ]);

                    return true;
                }
            } catch (QueryException $e) {
                $this->errors = $e->getMessage();
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
        $facultative = false;
        $response    = $this->getEvaluationResponse($detail->response);
        $imc         = $detail->client->imc;
        $reason      = '';

        if ($imc) {
            $reason .= str_replace([':name'], [$detail->client->full_name], $this->reasonImc) . '<br>';

            $facultative = true;
        }

        if ($response) {
            $reason .= str_replace([':name'], [$detail->client->full_name], $this->reasonResponse) . '<br>';

            $facultative = true;
        }

        if ($this->parameter->slug == 'FA') {
            $reason .= str_replace([':name', ':cumulus', ':amount_max'], [
                    $detail->client->full_name,
                    number_format($detail->cumulus, 2),
                    number_format(($this->parameter->amount_min - 1), 2)
                ], $this->reasonCumulus) . '<br>';

            $facultative = true;
        }

        if ($facultative) {
            $this->props['reason'] = $reason;
            $this->props['state']  = 'PE';
        }

        return $facultative;
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

}