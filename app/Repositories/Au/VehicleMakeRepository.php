<?php

namespace Sibas\Repositories\Au;

use Illuminate\Support\Collection;
use Sibas\Entities\Au\VehicleMake;
use Sibas\Repositories\BaseRepository;

class VehicleMakeRepository extends BaseRepository
{

    /**
     * @return Collection
     */
    public function getVehicleMakes()
    {
        return VehicleMake::with('models')->where('active', true)->orderBy('make', 'ASC')->get();
    }

}