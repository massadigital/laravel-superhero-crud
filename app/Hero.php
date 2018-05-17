<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $hero_id
 * @property string $hero_name
 * @property string $hero_catch_phrase
 * @property string $hero_origin_description
 *
 * @property \App\AlterEgo[] $alterEgos
 * @property \App\Image[] $images
 * @property \App\SuperPower[] $superPowers
 * @property \App\Person[] $persons
 * 
 * @author Carlos
 *
 */
class Hero extends Model
{
	
	protected $table = 'hero';
	
	protected $primaryKey = 'hero_id';
	
	public $timestamps= false;
	
	public function AlterEgos()
	{
		return $this->hasMany('App\AlterEgo','hero_id','hero_id');
	}
	
	public function Images()
	{
		return $this->belongsToMany('App\Image','hero_has_image','hero_id','image_id');
	}
	public function Persons()
	{
		return $this->belongsToMany('App\Person','alter_ego','hero_id','person_id');
	}
	
	public function SuperPowers()
	{
		return $this->belongsToMany('App\SuperPower','hero_has_super_power','hero_id','super_power_id');
	}
	
	public function attachSuperPowers(array $requestedPowers){
		
		if(!is_array($requestedPowers)){
			$requestedPowers=[];
		}
		
		$superPowers = SuperPower::all()->mapWithKeys(function($item){return [$item->super_power_id=>$item->super_power_id];});
		foreach ($requestedPowers as $k=>$requestedPower){
			if(!$superPowers->has($requestedPower)){
				$newPower = new SuperPower();
				$newPower->super_power_name = substr($requestedPower, 0,256);
				$valid = $newPower->validate();
				$saved= $newPower->save();
				if($newPower->validate() && $newPower->save()){
					$requestedPowers[$k] = $newPower->super_power_id;
				}else{
					unset($requestedPowers[$k]);
				}
			}
		}
		$this->SuperPowers()->detach($this->SuperPowers()->allRelatedIds());
		$this->SuperPowers()->attach( $requestedPowers);
		
	}
	public function attachPersons(array $requestedPersons){
		if(!is_array($requestedPersons)){
			$requestedPersons=[];
		}
		$persons = Person::all()->mapWithKeys(function($item){return [$item->person_id=>$item->person_id];});
		foreach ($requestedPersons as $k=>$requestedPerson){
			if(!$persons->has($requestedPerson)){
				$newPerson = new Person();
				$newPerson->person_name = substr($requestedPerson, 0,256);
				if($newPerson->validate() && $newPerson->save()){
					$requestedPersons[$k] = $newPerson->person_id;
				}else{
					unset($requestedPersons[$k]);
				}
			}
		}
		foreach ($this->persons as $person){
			if(($personIndex = array_search($person->person_id, $requestedPersons))===FALSE){
				$this->Persons()->detach($person->person_id);
			}else{
				unset($requestedPersons[$personIndex]);
			}
		}
		foreach ($requestedPersons as $k=>$requestedPerson){
			$alterEgo = new AlterEgo();
			$alterEgo->alter_ego_info = "Added in: " .date('d-m-Y H:n');
			$alterEgo->person_id = $requestedPerson;
			$this->AlterEgos()->save($alterEgo);
		}
		
		
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
