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

    public $titles;

    public function getPageTitle($title)
    {
        return Session::put('title', trans($title));
    }


    public function isAdmin()
    {
        if (\Cache::get('Admin')) {
            return true;
        }

        return false;
    }

    public function isEditor()
    {

        if (\Cache::get('Editor')) {
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