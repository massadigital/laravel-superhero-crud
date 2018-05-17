<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Http\JsonResponse;
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	foreach($request->files->all() as $k=>$v){
    		/**
    		 * @var \Symfony\Component\HttpFoundation\File\UploadedFile $v
    		 */
    		$request->file($k)->storeAs("temp/{$request->get("request_id")}", "{$v->getClientOriginalName()}");
        	
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
    	/**
    	 * 
    	 * @var Image $model
    	 */
    	$model = Image::find($id);
    	$model->Heroes()->detach($model->Heroes()->allRelatedIds());
    	$model->Persons()->detach($model->Persons()->allRelatedIds());
    	$response = new JsonResponse();
    	$response->setData(['deleted'=>true]);
    	return $response;
    	
    }
}
