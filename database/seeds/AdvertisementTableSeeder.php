<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class AdvertisementTableSeeder extends Seeder
{
    public function run()
    {
        factory('App\Src\Advertisement\Advertisement',4)->create();
    }
}
