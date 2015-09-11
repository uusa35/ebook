<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactus', function(Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->string('address');
            $table->integer('mobile');
            $table->integer('phone');
            $table->string('country');
            $table->integer('zipcode');
            $table->string('email');
            $table->string('youtube');
            $table->string('instagram');
            $table->string('twitter');
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
        Schema::drop('contactus');
    }
}
