<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookReadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_readers', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->integer('booklist_id');
            $table->integer('user_id');
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
		Schema::table('book_readers', function(Blueprint $table)
		{
            $table->drop();
		});
	}

}
