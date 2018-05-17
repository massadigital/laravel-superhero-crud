<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $alter_ego_id
 * @property string $alter_ego_info
 *
 * @property \App\Person $person
 * @property \App\Hero $hero
 *
 * @author Carlos
 *
 */

class AlterEgo extends Model
{
	
	protected $table = 'alter_ego';
	
	protected $primaryKey = 'alter_ego_id';
	
	public $timestamps= false;
	
	
	public function Person()
	{
		return $this->hasOne('App\Person','person_id','person_id');
	}
	
	public function Hero()
	{
		return $this->hasOne('App\Hero','hero_id','hero_id');
	}
	
	
}
