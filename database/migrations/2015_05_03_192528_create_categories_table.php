<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fields_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name_ar');
			$table->string('name_en');
			$table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fields_categories', function(Blueprint $table)
		{
            $table->drop();
		});
	}

}
