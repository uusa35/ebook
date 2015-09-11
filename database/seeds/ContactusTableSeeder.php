<?php

use Illuminate\Database\Seeder;

class ContactusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory('App\Src\Contactus\Contactus',1)->create();
    }
}
