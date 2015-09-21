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
use Illuminate\Support\Facades\Session;

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
        if (\Cache::get('role') === 'Admin') {
            return true;
        }

        return false;
    }

    public function isEditor()
    {

        if (\Cache::get('role') === 'Editor') {
            return true;
        }

        return false;
    }

    public function isAuthor()
    {

        if (\Cache::get('role') === 'Author') {
            return true;
        }

        return false;
    }

    public function getUserRole()
    {

        return \Cache::get('role');

    }

    public function isAdminOrEditor()
    {
        if (\Cache::get('Admin') || \Cache::get('Editor')) {

            return true;
        }

        return false;
    }

    public function isOwner($userId)
    {
        if ($userId === \Auth::id()) {
            return true;
        }
        return false;
    }
}