<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // this table responsible about favorites
        Schema::create('book_user', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id')->index();
            //$table->foreign('book_id')->references('id')->on('book');
            $table->unsignedInteger('user_id')->index();
            //$table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('book_user');
    }
}
