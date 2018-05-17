<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;
use App\Http\Requests\PersonUpdate;
use Illuminate\Support\Facades\Storage;
use App\Image;
use App\Grids\PersonGrid;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		$grid = new PersonGrid($request->all());
		return view('person.index', ['grid'=>$grid]);
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$model = new Person();
    	return view('person.create', ['model'=>$model]);
    	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonUpdate $request)
    {
    	$model = new Person();
    	
    	$model->person_name = $request->input('person_name');
    	$model->person_short_bio = $request->input('person_short_bio');
    	$model->save();
    	
    	$model->attachImages("temp/{$request->get("request_id")}");
    	
    	
    	$request->session()->flash('status', 'Record Created!');
    	
    	return redirect()->route('person.edit',$model->person_id);
    }
    
    
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $hero
     * @return \Illuminate\Http\Response
     */
    public function show(Person $hero)
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
    	$model = Person::find($id);
    	return view('person.edit', ['model'=>$model]);
    	
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PersonUpdate $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonUpdate $request, int $id)
    {
    	/**
    	 * 
    	 * @var \App\Person  $model
    	 */
    	$model = Person::find($id);
    	
    	$model->person_name = $request->input('person_name');
    	$model->person_short_bio = $request->input('person_short_bio');
    	
    	$model->save();
    	$model->attachImages("temp/{$request->get("request_id")}");
    	
    	
    	$request->session()->flash('status', 'Record Updated!');
    	return redirect()->route('person.edit',$model->person_id);
    	
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
    	 * @var \App\Person $model
    	 */
    	$model = Person::find($id);
    	$imagesAttached= $model->Images()->allRelatedIds();
    	$model->Images()->detach($imagesAttached);
    	Image::destroy($imagesAttached);
    	$model->Heroes()->detach($model->Heroes()->allRelatedIds());
    	Person::destroy($id);
        return redirect()->route('person.index');
        
    }
}
