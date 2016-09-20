<?php

namespace Sibas\Repositories\De;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\De\Facultative;
use Sibas\Entities\De\Header;
use Sibas\Entities\Rate;
use Sibas\Entities\RetailerProduct;
use Sibas\Repositories\BaseRepository;

class HeaderRepository extends BaseRepository
{

    /** Store a newly created Header in DB.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function createHeader($request)
    {
        $user       = $request->user();
        $this->data = $request->all();

        $this->model  = new Header();
        $quote_number = $this->getNumber('Q');

        $this->model->id                   = date('U');
        $this->model->ad_user_id           = $user->id;
        $this->model->type                 = 'Q';
        $this->model->quote_number         = $quote_number;
        $this->model->ad_coverage_id       = $this->data['coverage'];
        $this->model->amount_requested     = $this->data['amount_requested'];
        $this->model->currency             = $this->data['currency'];
        $this->model->term                 = $this->data['term'];
        $this->model->type_term            = $this->data['type_term'];
        $this->model->ad_credit_product_id = $this->data['credit_product'];
        $this->model->movement_type        = 'AD';
        $this->model->issued               = false;

        if ( ! $this->checkNumber('Q', $quote_number)) {
            return $this->saveModel();
        }

        return false;
    }


    /**
     * @param Request $request
     *
     * @return bool
     */
    public function updateHeader($request, $header_id)
    {
        $this->data = $request->all();

        if ($this->getHeaderById($header_id)) {
            $issue_number = $this->getNumber('I');

            $this->model->type             = 'I';
            $this->model->issue_number     = $issue_number;
            $this->model->prefix           = 'DE';
            $this->model->policy_number    = $this->data['policy_number'];
            $this->model->operation_number = $this->data['operation_number'];
            $this->model->facultative      = $this->setFacultative();

            if ( ! $this->checkNumber('I', $issue_number)) {
                return $this->saveModel();
            }
        }

        return false;
    }


    public function setFacultative($header = null)
    {
        if ($header instanceof Header) {
            $this->model = $header;
        }

        $facultative = false;

        foreach ($this->model->details as $detail) {
            if ($detail->facultative instanceof Facultative) {
                $facultative = true;

                break;
            }
        }

        return $facultative;
    }


    /**
     * @param Model|RetailerProduct $retailerProduct
     * @param Model|Header          $header
     *
     * @return bool
     */
    public function setHeaderResult($retailerProduct, $header)
    {
        if ($retailerProduct->rates->count() > 0) {
            $rate_final = 0;

            if ($header->creditProduct->slug === 'PMO') {
                $rate = $retailerProduct->rates()->whereHas('creditProduct', function ($q) {
                    $q->where('slug', 'PMO');
                })->first();

                if ($rate instanceof Rate) {
                    $rate_final = $rate->rate_final;

                    if ($header->coverage->slug === 'MC') {
                        $Fd = [
                            1 => 0,
                            2 => 0.10,
                            3 => 0.12,
                            4 => 0.17,
                        ];

                        $TR = $rate->rate_final;
                        $n  = $header->details->count();
                        $Fn = ( $n > 3 ) ? $Fd[4] : $Fd[$n];;

                        $rate_final = ( $TR * $n ) * ( 1 - $Fn );
                    }
                }
            } else {
                $rates = $retailerProduct->rates()->doesntHave('creditProduct')->get();

                foreach ($rates as $rate) {
                    if ($rate->ad_coverage_id === $header->ad_coverage_id) {
                        $rate_final = $rate->rate_final;

                        break;
                    }
                }
            }

            if ($rate_final > 0) {
                $header->ad_retailer_product_id = $retailerProduct->id;
                $header->total_rate             = $rate_final;
                $header->total_premium          = ( $header->amount_requested * $rate_final ) / 100;

                return $this->saveModel();
            }
        }

        return false;
    }


    public function issueHeader($header_id)
    {
        if ($this->getHeaderById($header_id)) {
            $this->model->issued     = true;
            $this->model->date_issue = $this->carbon->format('Y-m-d H:i:s');
            $this->model->approved   = true;

            return $this->saveModel();
        }

        return false;
    }


    /** Find Header by Id
     *
     * @param $header_id
     *
     * @return bool
     */
    public function getHeaderById($header_id)
    {
        $this->model = Header::with([
            'details.client.detailsVi',
            'details.beneficiaries',
            'details.facultative',
            'user.city',
            'coverageWarranty',
            'creditProduct'
        ])->where('id', '=', $header_id)->get();

        if ($this->model->count() === 1) {
            $this->model = $this->model->first();

            return true;
        }

        return false;
    }


    /**
     * @param Request $request
     * @param         $header_id
     *
     * @return bool
     */
    public function storeFacultative($request, $header_id)
    {
        if ($this->getHeaderById($header_id)) {
            $this->data = $request->all();

            $this->model->facultative_observation = $this->data['facultative_observation'];

            return $this->saveModel();
        }

        return false;
    }


    /**
     *
     * @return bool
     */
    public function storeSent()
    {
        $this->model->facultative_sent = true;

        return $this->saveModel();
    }


    /**
     * @param Request $request
     * @param string  $header_id
     *
     * @return bool
     */
    public function updateHeaderFacultative($request, $header_id)
    {
        $this->data = $request->all();

        if ($this->getHeaderById($header_id)) {
            $this->model->policy_number    = $this->data['policy_number'];
            $this->model->operation_number = $this->data['operation_number'];
            $this->model->term             = $this->data['term'];
            $this->model->type_term        = $this->data['type_term'];

            return $this->saveModel();
        }

        return false;
    }


    /**
     * @param Header $header
     *
     * @return bool
     */
    public function setApproved($header)
    {
        if ($header instanceof Header) {
            $this->model = $header;
            $details     = $this->model->details;
            $approved    = 0;
            $rejected    = 0;

            foreach ($details as $detail) {
                if ($detail->approved) {
                    $approved += 1;
                } elseif ($detail->rejected) {
                    $rejected += 1;
                }
            }

            if ($details->count() === $rejected) {
                $this->model->rejected = true;
            } elseif ($details->count() === ( $approved + $rejected )) {
                $this->model->approved = true;
            }

            return $this->saveModel();
        }

        return false;
    }


    /**
     * @param string $q
     *
     * @return bool
     */
    public function getPolicies($product, $q = '')
    {
        try {
            $this->model = Header::select('op_de_headers.id', 'issue_number',
                'prefix')->leftJoin('op_de_coverage_warranties', function ($q1) {
                $q1->on('op_de_headers.id', '=', 'op_de_coverage_warranties.op_de_header_id');
            });

            switch ($product) {
                case 'au':
                    $this->model->whereNull('op_au_header_id');
                    break;
                case 'td':
                    $this->model->whereNull('op_td_header_id');
                    break;
            }

            $this->model = $this->model->where('issued', true)->get();

            if ($this->model->count() > 0) {
                return true;
            }
        } catch (QueryException $e) {

        }

        return false;
    }

}