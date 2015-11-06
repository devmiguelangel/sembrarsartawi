<?php

namespace Sibas\Http\Requests\De;

use Sibas\Http\Requests\Request;

class HeaderCreateFormRequest extends Request
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
            'coverage' => 'required',
            'amount_requested' => 'required',
            'currency' => 'required',
            'term' => 'required',
            'type_term' => 'required',
        ];
    }
}
