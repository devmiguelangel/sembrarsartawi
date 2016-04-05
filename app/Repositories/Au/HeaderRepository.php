<?php

namespace Sibas\Repositories\Au;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\Au\Detail;
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
    public function setVehicleResult($retailerProduct, $header)
    {
        $premium_total = 0;

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

        if ($premium_total > 0) {
            try {
                $header->update([
                    'total_premium' => $premium_total,
                ]);

                return true;
            } catch (QueryException $e) {
                $this->errors = $e->getMessage();
            }
        }

        return false;
    }
}