<?php

namespace App\Core;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
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
        if (Cache::get('role.Admin.' . Auth::id()) === 'Admin') {

            return true;
        }

        return false;
    }

    public function isAdminSession()
    {
        if (Session::get('Admin')) {

            return true;

        }
        return false;
    }

    public function isEditor()
    {

        if (Cache::get('role.Editor.' . Auth::id()) === 'Editor') {

            return true;
        }

        return false;
    }

    public function isEditorSession()
    {
        if (Session::get('Editor')) {

            return true;

        }
        return false;
    }


    public function isAuthor()
    {

        if (Cache::get('role.Author.' . Auth::id()) === 'Author') {
            return true;
        }

        return false;
    }

    public function getUserRole()
    {

        return Cache::get('role.' . Auth::id());

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
        if (Session::get('roles')) {

            return Cache::get('Abilities.' . $this->getUserRole() . '.' . Auth::id());

        }
        return false;
    }
}