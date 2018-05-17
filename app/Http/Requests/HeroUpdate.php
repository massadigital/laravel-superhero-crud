<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HeroUpdate extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [ 
				'hero_name' => [ 
						'required',
						'max:256',
						Rule::unique ( 'hero' )->ignore ( $this->request->get ( 'model_id' ), 'hero_id' ) 
				],
				'hero_catch_phrase' => [ 
						'max:256' 
				] 
		];
	}
}
