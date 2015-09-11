<?php

use Illuminate\Database\Seeder;

class fieldsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Src\Category\Field\FieldCategory',5)->create();
    }
}
