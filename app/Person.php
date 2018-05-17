<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


/**
 * @property int $person_id
 * @property string $person_name
 *
 * @property App\AlterEgo[] $alterEgos
 * @property App\Images[] $images
 *
 * @author Carlos
 *
 */

class Person extends Model
{
	protected $table = 'person';
	
	protected $primaryKey = 'person_id';
	
	public $timestamps= false;
	
	private function rules(){
		return   [
				'person_name' => [
						'required',
						'max:256',
						Rule::unique('person')->ignore($this->person_id,'person_id')
				]
		];
	}
	
	public function validate($data=null)
	{
		$validator = Validator::make(is_array($data)?$data:$this->attributes, $this->rules());
		return $validator->passes();
	}
	
	public function AlterEgos()
	{
		return $this->hasMany('App\AlterEgo','person_id','person_id');
	}
	public function Heroes()
	{
		return $this->belongsToMany('App\Hero','alter_ego','person_id','hero_id');
	}
	
	public function Images()
	{
		return $this->belongsToMany('App\Image','person_has_image','person_id','image_id');
	}
	public function attachImages(string $fromPath, bool $deletePath = TRUE){
		$imageFiles = Storage::disk()->allFiles($fromPath);
		foreach ($imageFiles as $imageFile){
			$newPath = "public/images/" .uniqid("image")."_" .pathinfo($imageFile,PATHINFO_FILENAME).".".pathinfo($imageFile,PATHINFO_EXTENSION);
			Storage::disk()->move($imageFile, $newPath);
			
			$image = new Image();
			$image->image_file = $newPath;
			$image->image_url = Storage::url($newPath);
			
			$this->Images()->save($image);
		}
		if($deletePath){
			Storage::disk()->deleteDirectory($fromPath);
		}
	}
	
	
}
