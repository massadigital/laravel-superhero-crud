<?php

namespace App\Grids;

use App\AlterEgo;
use ViewComponents\Eloquent\EloquentDataProvider;
use ViewComponents\Grids\Grid;
use ViewComponents\ViewComponents\Component\ManagedList;
use ViewComponents\Grids\Component\TableCaption;
use ViewComponents\Grids\Component\ColumnSortingControl;
use ViewComponents\Grids\Component\Column;
use ViewComponents\ViewComponents\Component\Control\PaginationControl;
use ViewComponents\ViewComponents\Input\InputSource;
use ViewComponents\ViewComponents\Component\Control\PageSizeSelectControl;
use ViewComponents\ViewComponents\Component\Control\FilterControl;
use ViewComponents\ViewComponents\Data\Operation\FilterOperation;
use ViewComponents\Grids\Component\CsvExport;
use ViewComponents\ViewComponents\Customization\CssFrameworks\BootstrapStyling;
use ViewComponents\ViewComponents\Component\Html\Tag;
use ViewComponents\ViewComponents\Component\Html\TagWithText;
use ViewComponents\ViewComponents\Service\Services;

class AlterEgoGrid extends Grid 
{
	public function __construct($params){
		$query = AlterEgo::query()->getQuery()->select(['alter_ego.*','person.person_name','hero.hero_name'])
		->join('person','person.person_id','=','alter_ego.person_id')
		->join('hero','hero.hero_id','=','alter_ego.hero_id');
		$query = AlterEgo::query()->setQuery($query);
		$dataProvider = new EloquentDataProvider($query);
		$input = new InputSource($params);
		parent::__construct(
				$dataProvider,
				[
						(new Column('alter_ego_id'))->setLabel('Id'),
						(new Column('Hero_Photo'))
						->setValueCalculator(function ($row) {
							/**
							 * @var \App\AlterEgo $row
							 */
							if(count($row->hero->images)){
								
								return $row->hero->images[0]->image_url;
							}
							return "";
						})
						->setValueFormatter(function ($val) {
							$thumbnail= new Tag('span',['class'=>'grid-thumbnail']);
							$thumbnail->addChild(new Tag('img',['src'=>asset($val)]));
							return $thumbnail->render();
						}),
						(new Column('Hero_Name'))->setValueCalculator(function ($row) {
							/**
							 * @var \App\AlterEgo $row
							 */
							return $row->hero->hero_name;
						}),
						(new Column('Person_Photo'))
						->setValueCalculator(function ($row) {
							/**
							 * @var \App\AlterEgo $row
							 */
							if(count($row->person->images)){
								
								return $row->person->images[0]->image_url;
							}
							return "";
						})
						->setValueFormatter(function ($val) {
							$thumbnail= new Tag('span',['class'=>'grid-thumbnail']);
							$thumbnail->addChild(new Tag('img',['src'=>asset($val)]));
							return $thumbnail->render();
						}),
						(new Column('Person_Name'))->setDataFieldName('person.person_name')->setValueCalculator(function ($row) {
							/**
							 * @var \App\AlterEgo $row
							 */
							return $row->person->person_name;
						}),
						(new Column('Actions'))
						->setValueCalculator(function ($row) {
							/**
							 * @var \App\Hero $row
							 */
							return[
									(new TagWithText('a','Edit',[
											'class'=>'btn btn-xs btn-success',
											'href'=>route('alterego.edit',['id'=>$row->alter_ego_id]),
									]))->render(),
									(new TagWithText('a','Delete',[
											'class'=>'btn btn-xs btn-danger btn-crud-remove',
											'href'=>route('alterego.delete',['id'=>$row->alter_ego_id]),
									]))->render(),
							];
							
						})
						->setValueFormatter(function ($val) {
							return implode(' ', $val);
						}),
						
						 new PaginationControl($input->option('page', 1), 5), // 1 - default page, 5 -- page size
						 new PageSizeSelectControl($input->option('page_size', 5), [2, 5, 10]), // allows to select page size
						 new ColumnSortingControl('Hero_Name', $input->option('sort')),
						 new ColumnSortingControl('Person_Name', $input->option('sort')),
						 new FilterControl('hero_name', FilterOperation::OPERATOR_STR_STARTS_WITH, $input->option('hero')),
						 new FilterControl('person_name', FilterOperation::OPERATOR_STR_STARTS_WITH, $input->option('person')),
						 new CsvExport($input->option('csv')), // yep, that's so simple, you have CSV export now
				]
				);
		Services::resourceManager()
		->ignoreCss(['bootstrap'])
		->ignoreJs(['bootstrap']);
		
		$styling = new BootstrapStyling();
	
		$styling->apply($this);
	}
}