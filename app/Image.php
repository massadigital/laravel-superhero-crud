<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $image_id
 * @property string $image_file
 * @property string $image_url
 *
 * @property App\Person[] $persons
 * @property App\Hero[] $heroes
 *
 * @author Carlos
 *
 */
class Image extends Model
{
	
	protected $table = 'image';
	
	protected $primaryKey = 'image_id';
	
	public $timestamps= false;
	
	
	public function Persons()
	{
		return $this->belongsToMany('App\Person','person_has_image','image_id','person_id');
	}
	public function Heroes()
	{
		return $this->belongsToMany('App\Hero','hero_has_image','image_id','hero_id');
	}
	
}
