<?php

use Illuminate\Database\Seeder;

class BookMetasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory('App\Src\Book\BookMeta',10)->create();
    }
}
