<?php

namespace Sibas\Repositories\De;


use Illuminate\Support\Facades\DB;

class CoverageRepository
{

    public function getCoverage()
    {
        $coverages = DB::table('ad_coverages')
            ->select('id', 'name', 'slug as data_coverage')
            ->get();

        return $coverages;
    }
}