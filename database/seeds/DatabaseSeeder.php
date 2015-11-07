<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    private $tables = [
        'users',
        'user_followers',
        'roles',
        'role_user',
        'password_resets',
        'fields_categories',
        'langs_categories',
        'books',
        'chapters',
        'chapter_previews',
        'book_likes',
        'book_metas',
        'book_user',
        'messages',
        'sliders'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() == '') {
            Model::unguard();

            $this->cleanDatabase();
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            $this->call('UsersTableSeeder');
            $this->call('EntrustTableSeeder');
            $this->call('BooksTableSeeder');
            $this->call('fieldsCategoriesTableSeeder');
            $this->call('langsCategoriesTableSeeder');
            $this->call('BookMetasTableSeeder');
            $this->call('ContactusTableSeeder');
            $this->call('AdvertisementTableSeeder');
            $this->call('SlidersTableSeeder');
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        }

    }

    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
