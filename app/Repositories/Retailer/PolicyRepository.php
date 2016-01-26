<?php

namespace Sibas\Repositories\Retailer;

use Sibas\Entities\Policy;
use Sibas\Repositories\BaseRepository;

class PolicyRepository extends BaseRepository
{
    public function getPolicyByProduct($rp_id)
    {
        $policies = Policy::where('ad_retailer_product_id', $rp_id)->get();

        return $policies;
    }

    public function gerPolicyForIssuance($rp_id)
    {
        $policies = Policy::select('number as id', 'number as name')
            ->where('ad_retailer_product_id', $rp_id)
            ->get();

        return $policies;
    }
}