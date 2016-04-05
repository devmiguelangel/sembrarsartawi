<?php

namespace Sibas\Http\Requests\Au;

use Sibas\Http\Requests\Request;

class HeaderEditFormRequest extends Request
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
            'operation_number' => 'required|integer',
            'policy_number'    => 'required|exists:ad_policies,number',
        ];
    }
}
