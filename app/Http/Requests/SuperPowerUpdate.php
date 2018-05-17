<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class SuperPowerUpdate extends FormRequest
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
        		'super_power_name' => [
        				'required',
        				'max:256',
        				Rule::unique('super_power','super_power_name')->ignore($this->request->get('model_id'), 'super_power_id')
        	]
        ];
    }
}
