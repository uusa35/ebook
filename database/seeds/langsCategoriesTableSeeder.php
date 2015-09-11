<?php

use Illuminate\Database\Seeder;

class langsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Src\Category\Lang\LangCategory',5)->create();
    }
}
