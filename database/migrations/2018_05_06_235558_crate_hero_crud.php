<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateHeroCrud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	if (!Schema::hasTable('person')) {
    		Schema::create('person', function (Blueprint $table) {
    			$table->bigIncrements('person_id');
    			$table->string('person_name',256);
    			$table->text('person_short_bio')->nullable();
    			
    		});
    	}
    	
    	if (!Schema::hasTable('super_power')) {
    		Schema::create('super_power', function (Blueprint $table) {
    			$table->bigIncrements('super_power_id');
    			$table->string('super_power_name',256);
    		});
    	}
    	if (!Schema::hasTable('hero')) {
    		Schema::create('hero', function (Blueprint $table) {
    			$table->bigIncrements('hero_id');
    			$table->string('hero_name',256);
    			$table->string('hero_catch_phrase',256)->nullable();
    			$table->text('hero_origin_description')->nullable();
    		});
    	}
    		
    	if (!Schema::hasTable('image')) {
	    	Schema::create('image', function (Blueprint $table) {
	    		$table->bigIncrements('image_id');
	    		$table->string('image_file',256);
	    		$table->string('image_url',256);
	    	});
	    }
	    if (!Schema::hasTable('alter_ego')) {
	    	Schema::create('alter_ego', function (Blueprint $table) {
	    		$table->bigIncrements('alter_ego_id');
	    		$table->text('alter_ego_info')->nullable();
	    		$table->bigInteger('hero_id')->unsigned()->index();
	    		$table->bigInteger('person_id')->unsigned()->index();
	    		$table->foreign('hero_id')->references('hero_id')->on('hero');
	    		$table->foreign('person_id')->references('person_id')->on('person');
	    	});
	    }

	    if (!Schema::hasTable('hero_has_super_power')) {
	   		Schema::create('hero_has_super_power', function (Blueprint $table) {
	   			$table->bigInteger('hero_id')->unsigned()->index();
	   			$table->bigInteger('super_power_id')->unsigned()->index();
	   			$table->primary(['hero_id','super_power_id']);
	   			$table->foreign('hero_id')->references('hero_id')->on('hero');
	   			$table->foreign('super_power_id')->references('super_power_id')->on('super_power');
	   		});
	    }
	    	
	    if (!Schema::hasTable('person_has_image')) {
	    	Schema::create('person_has_image', function (Blueprint $table) {
	    		$table->bigInteger('person_id')->unsigned()->index();
	    		$table->bigInteger('image_id')->unsigned()->index();
	    		$table->primary(['person_id','image_id']);
	    		$table->foreign('person_id')->references('person_id')->on('person');
	    		$table->foreign('image_id')->references('image_id')->on('image');
	    	});
	    }
	    	
	    if (!Schema::hasTable('hero_has_image')) {
	    	Schema::create('hero_has_image', function (Blueprint $table) {
	    		$table->bigInteger('hero_id')->unsigned()->index();
	    		$table->bigInteger('image_id')->unsigned()->index();
	    		$table->primary(['hero_id','image_id']);
	    		$table->foreign('hero_id')->references('hero_id')->on('hero');
	    		$table->foreign('image_id')->references('image_id')->on('image');
	    	});
	    }
    				
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('hero_has_image');
    	Schema::dropIfExists('person_has_image');
    	Schema::dropIfExists('hero_has_super_power');
    	Schema::dropIfExists('alter_ego');
    	Schema::dropIfExists('image');
    	Schema::dropIfExists('hero');
    	Schema::dropIfExists('person');
    	
    }
}
