<?php

namespace App\Core;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 10/17/15
 * Time: 6:12 PM
 */
trait UserTrait
{
    public function getPageTitle($title)
    {
        $title = Config::get('title.' . $title);

        return Session::put('title', trans($title));
    }


    public function isAdmin()
    {
        if (Cache::get('ROLE.' . Auth::id()) === 'Admin') {

            return true;
        }

        return false;
    }

    public function isAdminSession()
    {
        if (Session::get('ROLE.Admin')) {

            return true;

        }

        return false;
    }

    public function isEditor()
    {

        if (Cache::get('ROLE.' . Auth::id()) === 'Editor') {

            return true;
        }

        return false;
    }


    public function isEditorSession()
    {
        if (Session::get('ROLE.Editor')) {

            return true;

        }

        return false;
    }

    public function isAuthorSession()
    {
        if (Session::get('ROLE.Author')) {

            return true;

        }

        return false;
    }


    public function isAuthor()
    {

        if (Cache::get('ROLE.' . Auth::id()) === 'Author') {

            return true;
        }

        return false;
    }

    public function getUserRole()
    {

        return Cache::get('ROLE.' . Auth::id());

    }


    public function isOwner($userId)
    {
        if ($userId === Auth::id()) {

            return true;
        }
        return false;
    }

    public function getUserAbilities()
    {

        return Cache::get('ABILITIES.' . Auth::id());

    }

    public function getUserModules()
    {
        return Cache::get('MODULES.' . Auth::id());
    }
}