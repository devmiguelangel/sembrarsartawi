<?php

namespace Sibas\Repositories;

use Sibas\Entities\Coverage;

class CoverageRepository
{

    public function getCoverage()
    {
        $coverages = Coverage::lists('name', 'id');

        return $coverages;
    }
}