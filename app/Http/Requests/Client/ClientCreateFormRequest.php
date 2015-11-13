<?php

namespace Sibas\Http\Requests\Client;

use Sibas\Http\Requests\Request;

class ClientCreateFormRequest extends Request
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
        $civil_status   = join(',', array_keys(\Config::get('base.client_civil_status')));
        $document_types = join(',', array_keys(\Config::get('base.client_document_types')));

        return [
            'first_name'        => 'required|regex:([A-Za-z]+)',
            'last_name'         => 'required|regex:([A-Za-z]+)',
            'mother_last_name'  => 'required|regex:([A-Za-z]+)',
            'married_name'      => 'regex:([A-Za-z]+)',
            'civil_status'      => 'required|in:' . $civil_status,
            'document_type'     => 'required|in:' . $document_types,
            'dni'               => 'required|regex:([A-Za-z0-9]+)',
            'complement'        => 'regex:([A-Za-z]+)',
            'extension'         => 'required|exists:ad_cities,abbreviation',
            'country'           => 'required',
            'birthdate'         => 'required',
            'birth_place'       => 'birth_place',
            'place_residence'   => 'required',
            'locality'          => 'required',
            'home_address'      => 'required',
            'ad_activity_id'    => 'required',
            'occupation_description' => 'required',
            'phone_number_home'      => 'required',
            'phone_number_mobile'    => '',
            'phone_number_office'    => '',
            'email'  => '',
            'weight' => 'required',
            'height' => 'required',
            'gender' => 'required'
        ];
    }
}
