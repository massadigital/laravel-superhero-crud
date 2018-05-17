<?php

namespace App\Http\Controllers;

use App\AlterEgo;
use Illuminate\Http\Request;
use App\Http\Requests\AlterEgoUpdate;
use App\Grids\AlterEgoGrid;
class AlterEgoController extends Controller
{

	public function index(Request $request)
	{
		$grid = new AlterEgoGrid($request->all());
		return view('alterego.index', ['grid'=>$grid]);
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$model = new AlterEgo();
    	return view('alterego.create', ['model'=>$model]);
    	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$model = new AlterEgo();
    	
    	$model->alter_ego_name = $request->input('alter_ego_name');
    	$model->save();
    	
    	$model->attachImages("temp/{$request->get("request_id")}");
    	
    	
    	$request->session()->flash('status', 'Record Created!');
    	
    	return redirect()->route('alterego.edit',$model->alter_ego_id);
    }
    
    
    
    /**
     * Display the specified resource.
     *
     * @param  \App\AlterEgo  $hero
     * @return \Illuminate\Http\Response
     */
    public function show(AlterEgo $hero)
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
    	$model = AlterEgo::find($id);
    	return view('alterego.edit', ['model'=>$model]);
    	
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AlterEgoUpdate $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
    	/**
    	 * 
    	 * @var \App\AlterEgo  $model
    	 */
    	$model = AlterEgo::find($id);
    	
    	$model->alter_ego_info = $request->input('alter_ego_info');
    	$model->save();
    	
    	
    	$request->session()->flash('status', 'Record Updated!');
    	return redirect()->route('alterego.edit',$model->alter_ego_id);
    	
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
    	 * @var \App\AlterEgo $model
    	 */
    	$model = AlterEgo::find($id);
    	AlterEgo::destroy($id);
        return redirect()->route('alterego.index');
        
    }
}
