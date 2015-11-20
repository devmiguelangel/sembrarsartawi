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
        $currencies = join(',', array_keys(\Config::get('base.currencies')));
        $term_types = join(',', array_keys(\Config::get('base.term_types')));

        return [
            'coverage'         => 'required|exists:ad_coverages,id',
            'amount_requested' => 'required|numeric|min:1',
            'currency'         => 'required|in:' . $currencies,
            'term'             => 'required|integer|min:1',
            'type_term'        => 'required|in:' . $term_types,
        ];
    }
}
