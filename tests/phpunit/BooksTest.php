<?php

use App\Src\Book\Book;
use App\Src\Role\Role;
use App\Src\User\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BooksTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * return all books for sepcific user
     */
    public function testGetAllBooksForSpecificUser() {

        $user = User::find(1)->with('roles');

        print_r($user->roles()->name);
        //die('end of test');

        //print_r('now the user is : '. $user->username . 'and user role is : '. $user->roles()->name);
//        $user = factory(User::class)->create();
//        $role = factory(Role::class)->create(['name' => 'admin']);
//        $user->roles()->attach($role);
//        $book = factory(Book::class)->create();
//        $book->user()->attach($user);
//        dd($book);

    }
}
