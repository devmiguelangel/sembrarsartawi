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
            'coverage' => 'required|exists:ad_coverages,id',
            'amount_requested' => 'required|numeric',
//            'currency' => 'required|in:' . join(',', array_keys(\Config::get('base.currencies'))),
            'currency' => 'required|in:' . join(',', array_keys(\Config::get('base.currencies'))),
            'term' => 'required|integer',
            'type_term' => 'required|in:' . join(',', array_keys(\Config::get('base.term_types'))),
        ];
    }
}
