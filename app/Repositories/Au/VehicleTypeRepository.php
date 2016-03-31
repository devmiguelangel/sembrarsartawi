<?php

namespace Sibas\Repositories\Au;

use Illuminate\Support\Collection;
use Sibas\Entities\Au\VehicleType;
use Sibas\Repositories\BaseRepository;

class VehicleTypeRepository extends BaseRepository
{

    /**
     * @return Collection
     */
    public function getVehicleType()
    {
        return VehicleType::with('category')->where('active', true)->orderBy('vehicle', 'ASC')->get();
    }
}