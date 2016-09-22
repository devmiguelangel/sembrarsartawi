<?php

namespace Sibas\Http\Requests\De;

use Sibas\Http\Requests\Request;

class BeneficiaryDeFormRequest extends Request
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
        $type = join(',', array_keys(config('base.beneficiary_coverages')));

        $rules = [
            'type'             => 'required|in:' . $type,
            'first_name'       => 'required|alpha_space',
            'last_name'        => 'required|alpha_space',
            'mother_last_name' => 'alpha_space',
            'relationship'     => 'required|alpha_space',
        ];

        if ($this->request->has('type')) {
            $type = $this->request->get('type');

            if ($type === 'SP') {
                $rules['dni']       = 'required|alpha_dash';
                $rules['extension'] = 'required|exists:ad_cities,abbreviation';
            } elseif ($type === 'VI' || $type === 'CO') {
                $rules['age'] = 'required|numeric';
            }
        }

        return $rules;
    }
}
