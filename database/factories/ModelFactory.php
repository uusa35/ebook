<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Illuminate\Support\Facades\DB;

$factory->define('App\Src\User\User', function ($faker) {
        return [
            'name' => $faker->name,
            //'name_ar' => $faker->country,
            'email' => "user".$faker->numberBetween(0,50)."@email.com",
            'active' => 1,
            'password' => Hash::make("admin"),
            'avatar' => 'http://lorempixel.com/150/150/sports'
        ];
});

$factory->define('App\Src\Book\Book', function ($faker) {
    return [
        'author_id' => 1,
        'serial' => $faker->numberBetween(10000000, 9999999999),
        'cover' => 'cover.png',
        //'cover_en' => '',
        //'cover_ar' => '',
        'views' => '',
        'field_category_id' => $faker->numberBetween(1, 10),
        'lang_category_id' => 1,
        'title'=> $faker->word,
        //'title_en' => $faker->word,
        //'title_ar' => $faker->word,
        'description' => $faker->paragraph(2),
        //'description_ar' => 'تفاصيل الموضوع تفاصيل الموضوع',
        //'description_en' => $faker->paragraph(2),
        'active' => 1,
        'free' => 1,
    ];
});

$factory->define('App\Src\Book\Chapter\Chapter', function ($faker) {
    return [
        'title' => $faker->word(5),
        'book_id' => $faker->numberBetween(1,10),
        'status' => $faker->array_rand(['pending','published','drafted','rejected']),
        'body' => $faker->paragraph(10)
    ];
});

$factory->define('App\Src\Contactus\Contactus', function ($faker) {
    return [
        'company' => $faker->company,
        'mobile' => $faker->phoneNumber,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'zipcode' => $faker->phoneNumber,
        'country' => $faker->country,
        'youtube' => $faker->country,
        'instagram' => $faker->country,
        'twitter' => $faker->country,
    ];
});

$factory->define('App\Src\Category\Field\FieldCategory', function ($faker) {
    return [
        'name_en' => $faker->name,
        'name_ar' => 'تصنيف' . $faker->phoneNumber,
    ];
});

$factory->define('App\Src\Category\Lang\LangCategory', function ($faker) {
    return [
        'name_en' => $faker->name,
        'name_ar' => 'تصنيف' . $faker->phoneNumber,
    ];
});

$factory->define('App\Src\Book\BookMeta', function ($faker) {
    return [
        'book_id' => $faker->numberBetween(1, 10),
        'total_pages' => $faker->randomDigit,
        'price' => $faker->randomDigit
    ];
});

/*$factory->define('App\Src\Role\Role', function ($faker) {
    return [
        'name' => $faker->randomElement(['Admin', 'Editor', 'Subscriber'])
    ];
});*/

$factory->define('App\Src\Advertisement\Advertisement', function ($faker) {
    return [
        'ads' => '/images/uploads/ads/ads.png'
    ];
});

$factory->define('App\Src\Slider\Slider', function ($faker) {
    return [
        'slide' => 'http://placehold.it/1500*900',
        'caption' => $faker->paragraph(1)
    ];
});

for ($i = 1; $i <= 23; $i++) {
    /*DB::table('user_roles')->insert([
        'user_id' => '1',
        'role_id' => rand(1, 3)
    ]);*/

    DB::table('book_report')->insert([
        'user_id' => rand(1, 3),
        'book_id' => rand(1, 3)
    ]);

    DB::table('permission_role')->insert([
        'permission_id' => $i+1,
        'role_id' => 1
    ]);

}

DB::table('conditions')->insert([
    'title_ar' => 'this is title arabic',
    'title_en' => 'this is title english',
    'body_ar' => 'this is the content in arabic',
    'body_en' => 'this is the content in english'
]);
