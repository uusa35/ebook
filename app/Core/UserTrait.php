<?php

namespace App\Core;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 10/17/15
 * Time: 6:12 PM
 */


trait UserTrait {
    public function getPageTitle($title)
    {
        $title = Config::get('title.' . $title);
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
}