<?php

namespace Sibas\Http\Requests\Client;

use Sibas\Http\Requests\Request;

class ClientComplementFormRequest extends Request
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
        $hands         = join(',', array_keys(\Config::get('base.client_hands')));
        $avenue_street = join(',', array_keys(\Config::get('base.avenue_street')));

        return [
            'hand'             => 'required|in:' . $hands,
            'avenue_street'    => 'required|in:' . $avenue_street,
            'home_number'      => 'required|numeric',
            'business_address' => 'required|ands_full',
        ];
    }
}
