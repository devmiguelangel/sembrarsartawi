<?php

namespace Sibas\Http\Requests\Td;

use Sibas\Http\Requests\Request;

class FacultativeRequestFormRequest extends Request
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
        //edw-->dd($this->request->all());
        return [
            'facultative_observation' => 'required|ands_full'
        ];
    }
}
