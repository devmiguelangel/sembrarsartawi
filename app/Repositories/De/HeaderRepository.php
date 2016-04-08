<?php

namespace Sibas\Repositories\De;

use Illuminate\Http\Request;
use Sibas\Entities\De\Facultative;
use Sibas\Entities\De\Header;
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

        $this->model->id               = date('U');
        $this->model->ad_user_id       = $user->id;
        $this->model->type             = 'Q';
        $this->model->quote_number     = $quote_number;
        $this->model->ad_coverage_id   = $this->data['coverage'];
        $this->model->amount_requested = $this->data['amount_requested'];
        $this->model->currency         = $this->data['currency'];
        $this->model->term             = $this->data['term'];
        $this->model->type_term        = $this->data['type_term'];
        $this->model->issued           = false;

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
     * Save data for Result Quote
     *
     * @param Request $request
     *
     * @return bool
     */
    public function storeResult($request, $header_id)
    {
        $this->data = $request->all();

        if ($this->getHeaderById($header_id)) {
            $this->model->total_rate    = $this->data['rate']->rate_final;
            $this->model->total_premium = ( $this->model->amount_requested * $this->data['rate']->rate_final ) / 100;

            return $this->saveModel();
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
            'details.beneficiary',
            'details.facultative',
            'user.city'
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

}