<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Config::get('CommentPack.model'),30)->create();
    }
}
