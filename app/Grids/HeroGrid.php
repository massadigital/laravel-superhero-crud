<?php

namespace App\Grids;

use App\Hero;
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

class HeroGrid extends Grid 
{
	public function __construct($params){
		
		$dataProvider = new EloquentDataProvider(Hero::class);
		$input = new InputSource($params);
		parent::__construct(
				$dataProvider,
				[
						(new Column('hero_id'))->setLabel('Id'),
						(new Column('Photo'))
						->setValueCalculator(function ($row) {
							/**
							 * @var \App\Hero $row
							 */
							if(count($row->images)){
								return $row->images[0]->image_url;
							}
							return "";
						})
						->setValueFormatter(function ($val) {
							$thumbnail= new Tag('span',['class'=>'grid-thumbnail']);
							$thumbnail->addChild(new Tag('img',['src'=>asset($val)]));
							return $thumbnail->render();
						}),
						(new Column('hero_name'))->setLabel('Name'),
						(new Column('Actions'))
						->setValueCalculator(function ($row) {
							/**
							 * @var \App\Hero $row
							 */
							return[
									(new TagWithText('a','Edit',[
											'class'=>'btn btn-xs btn-success',
											'href'=>route('hero.edit',['id'=>$row->hero_id]),
									]))->render(),
									(new TagWithText('a','Delete',[
											'class'=>'btn btn-xs btn-danger btn-crud-remove',
											'href'=>route('hero.delete',['id'=>$row->hero_id]),
									]))->render(),
							];
							
						})
						->setValueFormatter(function ($val) {
							return implode(' ', $val);
						}),
						
						 new PaginationControl($input->option('page', 1), 5), // 1 - default page, 5 -- page size
						 new PageSizeSelectControl($input->option('page_size', 5), [2, 5, 10]), // allows to select page size
						 new ColumnSortingControl('hero_id', $input->option('sort')),
						 new ColumnSortingControl('hero_name', $input->option('sort')),
						 new FilterControl('hero_name', FilterOperation::OPERATOR_LIKE, $input->option('name')),
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