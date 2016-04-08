<?php

namespace Sibas\Http\Requests\Au;

use Sibas\Http\Requests\Request;

class VehicleCreateFormRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $vehicle_categories = join(',', array_keys(config('base.vehicle_category')));
        $vehicle_uses       = join(',', array_keys(config('base.vehicle_use')));

        $rules = [
            'vehicle_type.id'   => 'required|exists:ad_vehicle_types,id',
            'category.category' => 'required|in:' . $vehicle_categories,
            'vehicle_make.id'   => 'required|exists:ad_vehicle_makes,id',
            'vehicle_model.id'  => 'required|exists:ad_vehicle_models,id',
            'year'              => 'required|integer',
            'license_plate'     => 'required|alpha_dash',
            'use'               => 'required|in:' . $vehicle_uses,
            'mileage'           => 'required|boolean',
            'insured_value'     => 'required|numeric|min:1',
        ];

        if ($this->request->get('year') === 'old') {
            $rules['year']     = 'required|in:old';
            $rules['year_old'] = 'required|integer';
        }

        return $rules;
    }
}
