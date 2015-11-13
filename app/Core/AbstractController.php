<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 8/31/15
 * Time: 10:40 AM
 */

namespace App\Core;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AbstractController extends Controller
{

    public $requestedRoute;
    public $titles;

    use UserTrait;


    public function getCountersForAdminAndEditor() {

        $counters = [
            'users' => DB::table('users')->count('id'),
            'books' => DB::table('books')->count('id'),
            //'favorites' => DB::table('book_user')->count('id'),
            'messages' => DB::table('messages')->count('id'),
            'categories' => DB::table('fields_categories')->count('id')
        ];

        Cache::put('counters',$counters,120);

    }

    public function getCountersForAuthor () {

        $counters = [

            'books' => DB::table('books')->where(['author_id' => Auth::id()])->count('id'),
            //'reports' => DB::table('book_user')->where(['user_id'=> Auth::id()])->count('id'),
            'favorites' => DB::table('book_user')->count('id'),
            'messages' => DB::table('messages')->where(['user_id'=>Auth::id()])->count('id'),

        ];

        Cache::put('counters',$counters,120);

    }
}