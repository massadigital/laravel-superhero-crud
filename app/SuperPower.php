<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

/**
 * @property int $super_power_id
 * @property string $super_power_name
 *
 * @property App\Hero[] $heroes
 *
 * @author Carlos
 *
 */

class SuperPower extends Model
{
	protected $table = 'super_power';
	
	protected $primaryKey = 'super_power_id';
	
	public $timestamps= false;
	
	public function rules(){ 
		return   [
			'super_power_name' => [
					'required',
					'max:256',
					Rule::unique('super_power','super_power_name')->ignore($this->super_power_id,'super_power_id')
			]
		];
	}
	
	public function validate()
	{
		$validator = Validator::make($this->attributes, $this->rules());
		return $validator->passes();
	}
	
	
	public function Heroes()
	{
		return $this->belongsToMany('App\Hero','hero_has_super_power','super_power_id','hero_id');
	}
}
