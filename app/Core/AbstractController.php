<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 8/31/15
 * Time: 10:40 AM
 */

namespace App\Core;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class AbstractController extends Controller
{

    public $requestedRoute;
    public $titles;

    public function __construct()
    {

    }

    public function getPageTitle($title)
    {
        $title = \Config::get('title.' . $title);
        return Session::put('title', trans($title));
    }


    public function isAdmin()
    {
        if (Cache::get('role') === 'Admin') {

            $this->getCountersForAdminAndEditor();

            return true;
        }

        return false;
    }

    public function isEditor()
    {

        if (Cache::get('role') === 'Editor') {

            $this->getCountersForAuthor();

            return true;
        }

        return false;
    }

    public function isAuthor()
    {

        if (Cache::get('role') === 'Author') {
            return true;
        }

        return false;
    }

    public function getUserRole()
    {

        return Cache::get('role');

    }

    public function isAdminOrEditor()
    {
        if (Cache::get('Admin') || Cache::get('Editor')) {

            return true;
        }

        return false;
    }

    public function isOwner($userId)
    {
        if ($userId === Auth::id()) {
            return true;
        }
        return false;
    }

    public function getCountersForAdminAndEditor() {

        $counters = [
            'users' => DB::table('users')->count('id'),
            'books' => DB::table('books')->count('id'),
            'reports' => DB::table('book_report')->count('id'),
            'favorites' => DB::table('book_user')->count('id'),
            'messages' => DB::table('messages')->count('id'),
            'categories' => DB::table('fields_categories')->count('id')
        ];

        Cache::put('counters',$counters,120);

    }

    public function getCountersForAuthor () {

        $counters = [

            'books' => DB::table('books')->where(['author_id' => Auth::id()])->count('id'),
            'reports' => DB::table('book_user')->where(['user_id'=> Auth::id()])->count('id'),
            'favorites' => DB::table('book_user')->count('id'),
            'messages' => DB::table('messages')->where(['user_id'=>Auth::id()])->count('id'),

        ];

        Cache::put('counters',$counters,120);

    }
}