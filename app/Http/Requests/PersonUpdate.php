<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class PersonUpdate extends FormRequest
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
        		'person_name' => [
        				'required',
        				'max:256',
        				Rule::unique('person','person_name')->ignore($this->request->get('model_id'), 'person_id')
        	]
        ];
    }
}
