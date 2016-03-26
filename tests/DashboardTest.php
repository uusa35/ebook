<?php


use App\Src\User\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;


class DashboardTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * Default preparation for each test
     */
    public function setUp()
    {
        parent::setUp();

        //$this->prepareForTests();
    }

    public function testIndexPage()
    {
        //$user = User::find(1);
//
//        $this->actingAs($user)
//            ->assertTrue()
//            ->visit('/backend')
    }
}

