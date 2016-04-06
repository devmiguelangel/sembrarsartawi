<?php

namespace Sibas\Repositories\Retailer;

use Sibas\Entities\Policy;
use Sibas\Repositories\BaseRepository;

class PolicyRepository extends BaseRepository
{

    /**
     * Policy by product
     *
     * @param string $rp_id
     *
     * @return mixed
     */
    public function getPolicyByProduct($rp_id)
    {
        return Policy::where('ad_retailer_product_id', $rp_id)->get();
    }


    /**
     * Policy for issuance
     *
     * @param string $rp_id
     *
     * @return mixed
     */
    public function gerPolicyForIssuance($rp_id)
    {
        return Policy::select('number as id', 'number as name')->where('ad_retailer_product_id', $rp_id)->get();
    }


    /**
     * Policy by currency
     *
     * @param string $rp_id
     * @param string $currency
     */
    public function getPolicyByCurrency($rp_id, $currency)
    {
        return Policy::select('number as id', 'number as name')->where('ad_retailer_product_id',
            $rp_id)->where('currency', $currency)->get();
    }
}