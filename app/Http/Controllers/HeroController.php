<?php

namespace App\Http\Controllers;

use App\Hero;
use Illuminate\Http\Request;
use App\Http\Requests\HeroUpdate;
use Illuminate\Support\Facades\Storage;
use App\Image;
use ViewComponents\Grids\Grid;
use App\Grids\HeroGrid;
class HeroController extends Controller
{
	public function index(Request $request)
    {
    	$grid = new HeroGrid($request->all());
    	return view('hero.index', ['grid'=>$grid]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$model = new Hero();
    	return view('hero.create', ['model'=>$model]);
    	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HeroUpdate $request)
    {
    	$model = new Hero();
    	
    	$model->hero_name = $request->input('hero_name');
    	$model->hero_catch_phrase = $request->input('hero_catch_phrase');
    	$model->hero_origin_description = $request->input('hero_origin_description');
    	$model->save();
    	
    	$model->attachImages("temp/{$request->get("request_id")}");
    	$model->attachSuperPowers($request->get('hero_powers',[]));
    	$model->attachPersons($request->get('hero_persons',[]));
    	
    	
    	$request->session()->flash('status', 'Record Created!');
    	
    	return redirect()->route('hero.edit',$model->hero_id);
    }
    
    /*
     * MOVIDO PARA O MODEL
    private function _attachImages(HeroUpdate $request, Hero $model){
    	$tempPath = "temp/{$request->get("request_id")}";
    	$imageFiles = Storage::disk()->allFiles($tempPath);
    	foreach ($imageFiles as $imageFile){
    		$newPath = "public/images/" .uniqid("image")."_" .pathinfo($imageFile,PATHINFO_FILENAME).".".pathinfo($imageFile,PATHINFO_EXTENSION);
    		Storage::disk()->move($imageFile, $newPath);
    		
    		$image = new Image();
    		$image->image_file = $newPath;
    		$image->image_url = Storage::url($newPath);
    		
    		$model->Images()->save($image);
    	}
    	Storage::disk()->deleteDirectory($tempPath);
    }
    private function _attachSuperPowers(HeroUpdate $request, Hero $model){
    	$requestedPowers = $request->get('hero_powers');
    	if(!is_array($requestedPowers)){
    		$requestedPowers=[];
    	}
    	
    	$superPowers = SuperPower::all()->mapWithKeys(function($item){return [$item->super_power_id=>$item->super_power_id];});
    	foreach ($requestedPowers as $k=>$requestedPower){
    		if(!$superPowers->has($requestedPower)){
    			$newPower = new SuperPower();
    			$newPower->super_power_name = substr($requestedPower, 0,256);
    			if($newPower->validate() && $newPower->save()){
    				$requestedPowers[$k] = $newPower->super_power_id;
    			}else{
    				unset($requestedPowers[$k]);
    			}
    		}
    	}
    	$model->SuperPowers()->detach($model->SuperPowers()->allRelatedIds());
    	$model->SuperPowers()->attach( $requestedPowers);
    	
    }
    private function _attachPersons(HeroUpdate $request, Hero $model){
    	$requestedPersons = $request->get('hero_persons');
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
    	foreach ($model->persons as $person){
    		if(($personIndex = array_search($person->person_id, $requestedPersons))===FALSE){
    			$model->Persons()->detach($person->person_id);
    		}else{
    			unset($requestedPersons[$personIndex]);
    		}
    	}
    	foreach ($requestedPersons as $k=>$requestedPerson){
    		$alterEgo = new AlterEgo();
    		$alterEgo->alter_ego_info = "Added in: " .date('d-m-Y H:n');
    		$alterEgo->person_id = $requestedPerson;
    		$model->AlterEgos()->save($alterEgo);
    	}
    	
    	
    }*/
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function show(Hero $hero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
    	$model = Hero::find($id);
    	return view('hero.edit', ['model'=>$model]);
    	
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  HeroUpdate $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HeroUpdate $request, int $id)
    {
    	/**
    	 * 
    	 * @var \App\Hero  $model
    	 */
    	$model = Hero::find($id);
    	
    	$model->hero_name = $request->input('hero_name');
    	$model->hero_catch_phrase = $request->input('hero_catch_phrase');
    	$model->hero_origin_description = $request->input('hero_origin_description');
    	$model->save();
    	$model->attachImages("temp/{$request->get("request_id")}");
    	$model->attachSuperPowers($request->get('hero_powers',[]));
    	$model->attachPersons($request->get('hero_persons',[]));
    	
    	
    	$request->session()->flash('status', 'Record Updated!');
    	return redirect()->route('hero.edit',$model->hero_id);
    	
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
    	/**
    	 * 
    	 * @var \App\Hero $model
    	 */
    	$model = Hero::find($id);
    	$imagesAttached= $model->Images()->allRelatedIds();
    	if($imagesAttached->count()){
    		$model->Images()->detach($imagesAttached);
    		Image::destroy($imagesAttached);
    	}
    	$model->SuperPowers()->detach($model->SuperPowers()->allRelatedIds());
    	$model->Persons()->detach($model->Persons()->allRelatedIds());
    	Hero::destroy($id);
        return redirect()->route('hero.index');
        
    }
}
