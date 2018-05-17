<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index.welcome');
})->name('home');

	Route::get('heroes', 'HeroController@index');
	Route::get('heroes/index', 'HeroController@index')->name('hero.index');
	Route::get('heroes/edit/{id}', 'HeroController@edit')->name("hero.edit");
	Route::post('heroes/update/{id}', 'HeroController@update')->name("hero.update");
	Route::get('heroes/create', 'HeroController@create')->name("hero.create");
	Route::post('heroes/delete/{id}', 'HeroController@destroy')->name("hero.delete");
	Route::post('heroes/store', 'HeroController@store')->name("hero.store");

	Route::post('images/store', 'ImageController@store')->name("image.store");
	Route::post('images/delete/{id}', 'ImageController@destroy')->name("image.delete");
	
	Route::get('superpowers', 'SuperPowerController@index');
	Route::get('superpowers/index', 'SuperPowerController@index')->name('superpower.index');
	Route::get('superpowers/edit/{id}', 'SuperPowerController@edit')->name("superpower.edit");
	Route::post('superpowers/update/{id}', 'SuperPowerController@update')->name("superpower.update");
	Route::get('superpowers/create', 'SuperPowerController@create')->name("superpower.create");
	Route::post('superpowers/delete/{id}', 'SuperPowerController@destroy')->name("superpower.delete");
	Route::post('superpowers/store', 'SuperPowerController@store')->name("superpower.store");
	
	Route::get('persons', 'PersonController@index');
	Route::get('persons/index', 'PersonController@index')->name('person.index');
	Route::get('persons/edit/{id}', 'PersonController@edit')->name("person.edit");
	Route::post('persons/update/{id}', 'PersonController@update')->name("person.update");
	Route::get('persons/create', 'PersonController@create')->name("person.create");
	Route::post('persons/delete/{id}', 'PersonController@destroy')->name("person.delete");
	Route::post('persons/store', 'PersonController@store')->name("person.store");
	
	Route::get('alteregos', 'AlterEgoController@index');
	Route::get('alteregos/index', 'AlterEgoController@index')->name('alterego.index');
	Route::get('alteregos/edit/{id}', 'AlterEgoController@edit')->name("alterego.edit");
	Route::post('alteregos/update/{id}', 'AlterEgoController@update')->name("alterego.update");
	Route::post('alteregos/delete/{id}', 'AlterEgoController@destroy')->name("alterego.delete");
	
	
