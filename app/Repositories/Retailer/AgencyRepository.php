<?php

namespace Sibas\Repositories\Retailer;

use Sibas\Entities\Agency;
use Sibas\Repositories\BaseRepository;

class AgencyRepository extends BaseRepository
{
    /**
     * @param int $retailer_id
     * @return mixed
     */
    public function getAgenciesByRetailer($retailer_id)
    {
        return Agency::with('retailerCityAgencies.retailerCity')
            ->whereHas('retailerCityAgencies.retailerCity', function($q) use ($retailer_id) {
                $q->where('ad_retailer_id', $retailer_id);
            })
            ->get();
    }

}