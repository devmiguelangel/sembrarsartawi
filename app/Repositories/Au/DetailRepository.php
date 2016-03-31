<?php

namespace Sibas\Repositories\Au;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\Au\Header;
use Sibas\Repositories\BaseRepository;

class DetailRepository extends BaseRepository
{

    /**
     * @param Request      $request
     * @param Model|Header $header
     *
     * @return bool
     */
    public function storeVehicle($request, $header)
    {
        $this->data = $request->all();

        try {
            $header->details()->create([
                'id'                  => date('U'),
                'ad_vehicle_type_id'  => $this->data['vehicle_type']['id'],
                'ad_vehicle_make_id'  => $this->data['vehicle_make']['id'],
                'ad_vehicle_model_id' => $this->data['vehicle_model']['id'],
                'category'            => $this->data['category']['category'],
                'year'                => $this->data['year'],
                'license_plate'       => $this->data['license_plate'],
                'use'                 => $this->data['use'],
                'mileage'             => (boolean) $this->data['mileage'],
                'insured_value'       => $this->data['insured_value'],
            ]);

            return true;
        } catch (QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }
}