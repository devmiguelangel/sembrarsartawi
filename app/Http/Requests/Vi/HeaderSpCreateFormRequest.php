<?php

namespace Sibas\Http\Requests\Vi;

use Sibas\Http\Requests\Request;

class HeaderSpCreateFormRequest extends Request
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
        $payment_methods = join(',', array_keys(\Config::get('base.payment_methods')));
        $periods         = join(',', array_keys(\Config::get('base.periods')));

        return [
            // 'header_id'        => 'required|exists:op_de_headers,id',
            // 'detail_id'        => 'required|exists:op_de_details,id',
            'payment_method'   => 'required|in:' . $payment_methods,
            'period'           => 'required|in:' . $periods,
            'account_number'   => 'required|numeric',
            'credit_card'      => 'numeric',
            'plan'             => 'required|exists:ad_plans,id',
            'home_number'      => 'numeric',
            'business_address' => 'ands_full',
            'taker_name'       => 'required|alpha_space',
            'taker_dni'        => 'required|alpha_dash',
        ];
    }

    public function getValidatorInstance()
    {
        $input = $this->request->all();
        // $input['header_id'] = decode($input['header_id']);
        // $input['detail_id'] = decode($input['detail_id']);

        $this->request->replace($input);

        return parent::getValidatorInstance();
    }
}
