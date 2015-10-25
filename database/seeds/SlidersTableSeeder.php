<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class SlidersTableSeeder extends Seeder
{
    public function run()
    {
        factory('App\Src\Slider\Slider',3)->create();
    }
}
