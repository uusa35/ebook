<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapterPreviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter_previews', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('chapter_id');
            $table->integer('book_id');
            $table->integer('author_id');
            $table->integer('preview_start');
            $table->integer('preview_end');
            $table->integer('total_pages');
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
        Schema::drop('chapter_previews');
    }
}
