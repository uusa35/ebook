<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('serial');
            $table->integer('author_id');
            $table->integer('field_category_id');
            $table->integer('lang_category_id');
            $table->string('title');
            $table->text('description');
            $table->string('cover');
            $table->boolean('free')->default(1); // url or html
            $table->bigInteger('views'); // url or html
            $table->enum('active',[0,1]);
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
		Schema::table('books', function(Blueprint $table)
		{
			//
            $table->drop();
		});
	}

}
