<?php

namespace Sibas\Http\Requests\De;

use Sibas\Http\Requests\Request;

class MedicalCertificateFormRequest extends Request
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
        return [
            'mcid'             => 'required',
            'center_attention' => 'required|ands_full',
            'contact_person'   => 'required|ands_full',
            'answers'          => 'required|array'
        ];
    }
}
