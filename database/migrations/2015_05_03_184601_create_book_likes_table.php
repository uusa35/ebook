<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookLikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_likes', function(Blueprint $table)
		{
			//
            $table->increments('id');
			$table->integer('book_id')->foreign('book_id')->references('id')->on('books')
				  ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('book_likes', function(Blueprint $table)
		{
            $table->drop();
		});
	}

}
