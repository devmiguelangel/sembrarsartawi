<?php

namespace Sibas\Http\Requests\De;

use Sibas\Http\Requests\Request;

class FacultativeFormRequest extends Request
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
        $data = $this->request->all();

        $rules = [
            'approved'     => 'required|integer|min:1|max:2',
            'surcharge'    => 'required|boolean',
            'percentage'   => 'required|integer|min:0|max:100',
            'current_rate' => 'required|numeric',
            'final_rate'   => 'required|numeric',
            'state.id'     => 'required|exists:ad_states,id',
            'observation'  => 'required|ands_full',
            'emails'       => 'required'
        ];

        foreach ($data['emails'] as $key => $email) {
            if (! empty($email)) {
                $rules['emails.' . $key] = 'email';
            }
        }

        return $rules;
    }
}
