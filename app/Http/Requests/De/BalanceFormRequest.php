<?php

namespace Sibas\Http\Requests\De;

use Sibas\Http\Requests\Request;

class BalanceFormRequest extends Request
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
            'amount_requested' => 'required|numeric|min:1',
            'balance'          => 'required|numeric',
        ];
    }
}
