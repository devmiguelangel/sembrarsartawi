<?php

namespace Sibas\Repositories\Au;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Sibas\Entities\Au\Detail;
use Sibas\Entities\Au\Header;
use Sibas\Repositories\BaseRepository;

class DetailRepository extends BaseRepository
{

    /**
     * Get Detail by Id
     *
     * @param $detail_id
     *
     * @return bool
     */
    public function getDetailById($detail_id)
    {
        $this->model = Detail::with([
            'vehicleType',
            'vehicleMake',
            'vehicleModel',
            'category',
            'header',
            'facultative',
        ])->where('id', $detail_id)->first();

        if ($this->model instanceof Detail) {
            return true;
        }

        return false;
    }


    /**
     * Store Detail vehicle
     *
     * @param Request      $request
     * @param Model|Header $header
     *
     * @return bool
     */
    public function storeVehicle($request, $header)
    {
        $this->data = $request->all();

        try {
            if ($this->data['year'] === 'old') {
                $this->data['year'] = $this->data['year_old'];
            }

            $header->details()->create([
                'id'                              => date('U'),
                'ad_vehicle_type_id'              => $this->data['vehicle_type']['id'],
                'ad_vehicle_make_id'              => $this->data['vehicle_make']['id'],
                'ad_vehicle_model_id'             => $this->data['vehicle_model']['id'],
                'ad_retailer_product_category_id' => $this->data['category']['id'],
                'year'                            => $this->data['year'],
                'license_plate'                   => $this->data['license_plate'],
                'use'                             => $this->data['use'],
                'mileage'                         => (boolean) $this->data['mileage'],
                'insured_value'                   => $this->data['insured_value'],
            ]);

            return true;
        } catch (QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }


    /**
     * Remove vehicle from storage.
     */
    public function removeVehicle()
    {
        try {
            $this->model->delete();

            return true;
        } catch (QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }


    /**
     * Update vehicle
     *
     * @param Request $request
     *
     * @return bool
     */
    public function updateVehicle(Request $request)
    {
        $this->data = $request->all();

        try {
            if ($this->data['year'] === 'old') {
                $this->data['year'] = $this->data['year_old'];
            }

            $this->model->update([
                'ad_vehicle_type_id'              => $this->data['vehicle_type']['id'],
                'ad_vehicle_make_id'              => $this->data['vehicle_make']['id'],
                'ad_vehicle_model_id'             => $this->data['vehicle_model']['id'],
                'ad_retailer_product_category_id' => $this->data['category']['id'],
                'year'                            => $this->data['year'],
                'license_plate'                   => $this->data['license_plate'],
                'use'                             => $this->data['use'],
                'mileage'                         => (boolean) $this->data['mileage'],
                'insured_value'                   => $this->data['insured_value'],
            ]);

            return true;
        } catch (QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }


    /**
     * Update vehicle issuance
     *
     * @param Request $request
     *
     * @return bool
     */
    public function updateVehicleIssuance(Request $request)
    {
        $this->data = $request->all();

        try {
            if ($this->data['year'] === 'old') {
                $this->data['year'] = $this->data['year_old'];
            }

            $this->model->update([
                'ad_vehicle_type_id'              => $this->data['vehicle_type']['id'],
                'ad_vehicle_make_id'              => $this->data['vehicle_make']['id'],
                'ad_vehicle_model_id'             => $this->data['vehicle_model']['id'],
                'ad_retailer_product_category_id' => $this->data['category']['id'],
                'year'                            => $this->data['year'],
                'license_plate'                   => $this->data['license_plate'],
                'use'                             => $this->data['use'],
                'mileage'                         => (boolean) $this->data['mileage'],
                'color'                           => $this->data['color'],
                'engine'                          => $this->data['engine'],
                'chassis'                         => $this->data['chassis'],
                'tonnage_capacity'                => $this->data['tonnage_capacity'],
                'seat_number'                     => $this->data['seat_number'],
            ]);

            return true;
        } catch (QueryException $e) {
            $this->errors = $e->getMessage();
        }

        return false;
    }

}