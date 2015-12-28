<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class CommentsChildrenTableSeeder extends Seeder
{
    public function run()
    {
        factory(Config::get('CommentPack.childModel'),30)->create();
    }
}
