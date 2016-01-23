<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookMetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_metas', function(Blueprint $table)
		{
			//
            $table->increments('id');
			$table->integer('book_id')->foreign('book_id')->references('id')->on('books')
				  ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('total_chapters')->nullable();
			$table->integer('total_pages')->nullable();
            $table->decimal('price',6,2)->nullable();
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
		Schema::table('book_metas', function(Blueprint $table)
		{
			//
            $table->drop();
		});
	}

}
