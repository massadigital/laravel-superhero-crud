<?php

namespace App\Http\Controllers;

use App\SuperPower;
use Illuminate\Http\Request;
use App\Http\Requests\SuperPowerUpdate;
use App\Grids\SuperPowerGrid;



class SuperPowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$grid = new SuperPowerGrid($request->all());
    	return view('superpower.index', ['grid'=>$grid]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$model = new SuperPower();
    	return view('superpower.create', ['model'=>$model]);
    	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuperPowerUpdate $request)
    {
    	$model = new SuperPower();
    	
    	$model->super_power_name = $request->input('super_power_name');
    	if($model->validate()){
    		$model->save();
    	}
    	
    	
    	$request->session()->flash('status', 'Record Created!');
    	
    	return redirect()->route('superpower.edit',$model->super_power_id);
    }
    
 
    
    /**
     * Display the specified resource.
     *
     * @param  \App\SuperPower  $hero
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
    	$model = SuperPower::find($id);
    	return view('superpower.edit', ['model'=>$model]);
    	
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  HeroUpdate $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuperPowerUpdate $request, int $id)
    {
    	/**
    	 * 
    	 * @var \App\SuperPower  $model
    	 */
    	$model = SuperPower::find($id);
    	
    	$model->super_power_name = $request->input('super_power_name');
    	if($model->validate()){
    		$model->save();
    	}
    	
    	
    	
    	$request->session()->flash('status', 'Record Updated!');
    	return redirect()->route('superpower.edit',$model->super_power_id);
    	
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
    	 * @var \App\SuperPower $model
    	 */
    	$model = SuperPower::find($id);
    	$model->Heroes()->detach($model->Heroes()->allRelatedIds());
    	SuperPower::destroy($id);
        return redirect()->route('superpower.index');
        
    }
}
