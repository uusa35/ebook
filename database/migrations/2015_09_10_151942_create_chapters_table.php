<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id');
            $table->string('title');
            $table->longText('body');
            $table->text('url');
            $table->integer('total_pages');
            $table->enum('status',['pending','drafted','published','declined']);
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
        Schema::drop('chapters');
    }
}
