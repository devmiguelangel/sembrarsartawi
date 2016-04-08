<?php

namespace Sibas\Repositories\Au;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Sibas\Entities\Au\Detail;
use Sibas\Entities\Au\Facultative;
use Sibas\Entities\ProductParameter;
use Sibas\Entities\RetailerProduct;
use Sibas\Entities\User;
use Sibas\Repositories\BaseRepository;

class FacultativeRepository extends BaseRepository
{

    /**
     * Store vehicle Facultative
     *
     * @param Model|Detail          $detail
     * @param Model|RetailerProduct $retailerProduct
     * @param Model|User            $user
     *
     * @return bool
     */
    public function storeFacultative($detail, $retailerProduct, $user)
    {
        $parameter     = $retailerProduct->parameters()->where('slug', 'GE')->first();
        $exchange_rate = $retailerProduct->retailer->exchangeRate;
        $reason        = '';

        if ($parameter instanceof ProductParameter) {
            $year_max      = date('Y') - $parameter->old_car;
            $insured_value = $detail->insured_value;

            if ($detail->header->currency === 'BS') {
                $insured_value = $detail->insured_value / $exchange_rate->bs_value;
            }

            $year   = ( $detail->year < $year_max ) ? true : false;
            $amount = ( $insured_value > $parameter->amount_max ) ? true : false;

            $reason .= $year ? str_replace([ ':license_plate', ':year_max' ],
                    [ $detail->license_plate, $parameter->old_car ], $this->reasonYear) . '<br>' : '';
            $reason .= $amount ? str_replace([ ':license_plate', ':amount_max' ],
                    [ $detail->license_plate, number_format($parameter->amount_max, 2) ],
                    $this->reasonAmount) . '<br>' : '';

            try {
                if ($year || $amount) {
                    if ($detail->facultative instanceof Facultative) {
                        $detail->facultative->update([
                            'reason' => $reason,
                            'state'  => 'PE',
                            'read'   => false,
                        ]);
                    } else {
                        $detail->facultative()->create([
                            'id'         => date('U'),
                            'ad_user_id' => $user->id,
                            'reason'     => $reason,
                            'state'      => 'PE',
                            'read'       => false,
                        ]);
                    }
                } elseif ($detail->facultative instanceof Facultative) {
                    $detail->facultative->delete();
                }

                return true;
            } catch (QueryException $e) {
                $this->errors = $e->getMessage();
            }
        }

        return false;
    }
}