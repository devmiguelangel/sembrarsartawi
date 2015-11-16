<?php

namespace Sibas\Http\Requests\Client;

use Sibas\Http\Requests\Request;
use Sibas\Repositories\Retailer\RetailerProductRepository;

class QuestionFormRequest extends Request
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
        $rules = [
            'qs_number' => 'required|numeric|min:0'
        ];

        foreach ($this->request->get('qs') as $key => $items) {
            $rules['qs.' . $key . '.value'] = 'required|in:1,0';
        }

        return $rules;
    }
}
