<?php

namespace Sibas\Repositories\Retailer;

use Sibas\Entities\RetailerProductCoverage;
use Sibas\Repositories\BaseRepository;

class RetailerProductCoverageRepository extends BaseRepository
{
    public function getCoverageByProduct($rp_id)
    {
        $selectOption = $this->getSelectOption();

        $productCoverages = RetailerProductCoverage::with('coverage')
            ->where('ad_retailer_product_id', $rp_id)->get();

        $coverages = [];

        foreach ($productCoverages as $productCoverage) {
            $coverages[] = [
                'id'            => $productCoverage->coverage->id,
                'name'          => $productCoverage->coverage->name,
                'data_coverage' => $productCoverage->coverage->slug,
            ];
        }

        $coverages = $selectOption->merge($coverages);

        return $coverages;
    }
}