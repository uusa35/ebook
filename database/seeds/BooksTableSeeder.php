<?php

use comApp\Src\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BooksTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Src\Book\Book',10)->create();
    }
}