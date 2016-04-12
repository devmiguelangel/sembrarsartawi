<?php

namespace Sibas\Repositories\Au;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\Au\Detail;
use Sibas\Entities\Au\Facultative;
use Sibas\Entities\Client;
use Sibas\Entities\Au\Header;
use Sibas\Entities\RetailerProduct;
use Sibas\Repositories\BaseRepository;

class HeaderRepository extends BaseRepository
{

    public function getHeaderById($header_id)
    {
        $this->model = Header::with([
            'client',
            'details.vehicleType',
            'details.vehicleMake',
            'details.vehicleModel',
            'details.category',
        ])->where('id', '=', $header_id)->get();

        if ($this->model->count() === 1) {
            $this->model = $this->model->first();

            return true;
        }

        return false;
    }


    /**
     *
     * Store Header AU
     *
     * @param Request      $request
     * @param Model|Client $client
     *
     * @return bool
     */
    public function storeHeader($request, $client)
    {
        $this->data = $request->all();

        $this->model  = new Header();
        $quote_number = $this->getNumber('Q');

        $date = $this->carbon->createFromTimestamp(strtotime(str_replace('/', '-', $this->data['validity_start'])));

        $this->model->id             = date('U');
        $this->model->ad_user_id     = $request->user()->id;
        $this->model->op_client_id   = $client->id;
        $this->model->type           = 'Q';
        $this->model->quote_number   = $quote_number;
        $this->model->warranty       = (boolean) $this->data['warranty'];
        $this->model->validity_start = $date->format('Y-m-d');
        $this->model->validity_end   = $date->addYear(1)->format('Y-m-d');
        $this->model->payment_method = $this->data['payment_method'];
        $this->model->currency       = $this->data['currency'];
        $this->model->term           = $this->data['term'];
        $this->model->type_term      = $this->data['type_term'];

        if ( ! $this->checkNumber('Q', $quote_number)) {
            return $this->saveModel();
        }

        return false;
    }


    /**
     * @param Model|RetailerProduct $retailerProduct
     * @param Model|Header          $header
     *
     * @return array
     */
    public function setVehicleResult($retailerProduct = null, $header)
    {
        $premium_total = 0;

        if ($retailerProduct instanceof RetailerProduct) {
            $max_year = $retailerProduct->rates()->max('year');

            foreach ($retailerProduct->rates as $rate) {
                if ($header->full_year == $rate->year || ( $header->full_year > $max_year && $rate->year == $max_year )) {
                    /**
                     * @var Detail $detail
                     */
                    foreach ($header->details as $detail) {
                        foreach ($rate->increments as $increment) {
                            if ($increment->category->category == $detail->category->category) {
                                $rate_vh    = $rate->rate_final + $increment->increment;
                                $premium_vh = ( $rate_vh * $detail->insured_value ) / 100;;

                                if ($header->full_year > $max_year) {
                                    $rate_annual = $rate_vh / $max_year;
                                    $rate_vh     = $rate_annual * $header->full_year;
                                    $premium_vh  = ( $rate_vh * $detail->insured_value ) / 100;

                                    if ($header->payment_method === 'PT') {
                                        $premium_diff = ( $premium_vh * 10 ) / 100;
                                        $premium_vh   = $premium_vh - $premium_diff;
                                    }
                                }

                                $premium_total += $premium_vh;

                                try {
                                    $detail->update([
                                        'rate'    => $rate_vh,
                                        'premium' => $premium_vh,
                                    ]);
                                } catch (QueryException $e) {
                                    $this->errors = $e->getMessage();

                                    return false;
                                }
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($header->details as $detail) {
                $premium_total += $detail->premium;
            }
        }

        if ($premium_total > 0) {
            $share = [ ];

            if ($header->payment_method === 'AN') {
                $date       = Carbon::createFromDate(null, null, 15)->addMonth(1)->subYear();
                $percentage = number_format(( 100 / $header->full_year ), 2, '.', ',');

                for ($i = 1; $i <= $header->full_year; $i++) {
                    array_push($share, [
                        'number'     => $i,
                        'date'       => $date->addYear()->toDateString(),
                        'percentage' => $percentage,
                        'share'      => number_format(( $premium_total * $percentage ) / 100, 2),
                    ]);
                }
            }

            try {
                $header->update([
                    'total_premium' => $premium_total,
                    'share'         => json_encode($share),
                ]);

                return true;
            } catch (QueryException $e) {
                $this->errors = $e->getMessage();
            }
        }

        return false;
    }


    /**
     * Set facultative
     *
     * @param $header_id
     */
    public function setHeaderFacultative($header_id)
    {
        if ($this->getHeaderById($header_id)) {
            $facultative = false;
            $reason      = '';

            foreach ($this->model->details as $detail) {
                if ($detail->facultative instanceof Facultative) {
                    $facultative = true;
                    $reason .= $detail->facultative->reason;
                }
            }

            try {
                $this->model->update([
                    'facultative'             => $facultative,
                    'facultative_observation' => $reason,
                ]);
            } catch (QueryException $e) {
                $this->errors = $e->getMessage();
            }
        }
    }


    /**
     * Update Header AU
     *
     * @param Request $request
     *
     * @return bool
     */
    public function updateHeader(Request $request)
    {
        $this->data = $request->all();

        try {
            $issue_number = $this->getNumber('I');

            if ( ! $this->checkNumber('I', $issue_number)) {
                $this->model->update([
                    'type'             => 'I',
                    'issue_number'     => $issue_number,
                    'prefix'           => 'AU',
                    'policy_number'    => $this->data['policy_number'],
                    'operation_number' => $this->data['operation_number'],
                ]);

                return true;
            }
        } catch (QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }


    /**
     * Issuance Header AU
     */
    public function issuanceHeader()
    {
        try {
            $this->model->update([
                'issued'     => true,
                'date_issue' => date('Y-m-d H:i:s'),
                'approved'   => true,
            ]);

            return true;
        } catch (QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }


    /**
     * Store Header facultative
     *
     * @param string $request
     *
     * @return bool
     */
    public function storeFacultative($request)
    {
        $this->data = $request->all();

        $this->model->facultative_observation = $this->data['facultative_observation'];

        return $this->saveModel();
    }


    /**
     * Store Sent Header facultative
     *
     * @return bool
     */
    public function storeSent()
    {
        $this->model->facultative_sent = true;

        return $this->saveModel();
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

            return $this->saveModel();
        }

        return false;
    }

}