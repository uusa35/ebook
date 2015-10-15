<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 9/20/15
 * Time: 2:51 PM
 */

namespace App\Core;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AbstractPolicy
{


    /*
     * 1- Abstract Policy created
     * 2- get the role of a user from the cache
     * 3- get the all permissions from the cache
     * 4- search in the array of permissions if the requested link is granted access for each method CRUD
     * 5- One Case Example : you can not add chapter unless you have access to edit the book itself.
     * */
    public $userRole;
    public $userAbilities;
    public $moduleRequested;
    public $permName;

    public function __construct()
    {
        $this->userRole = Cache::get('role');
        $this->userAbilities = Cache::get('Abilities.' . $this->userRole);

    }

    public function getModule()
    {
        return $this->moduleRequested = str_singular(strtolower(\Session::get('module')));
    }


    public function create()
    {

        //dd(Cache::get('module'));
        //dd($this->moduleRequested);
        //dd($this->userAbilities);
        //dd($this->userAbilities);
        //dd($this->getModule());
        if (in_array($this->getModule() . '_create', $this->userAbilities, true)) {

            return true;
        }

        return false;
    }


    /**
     * @return bool
     */
    public function edit()
    {
        if (in_array($this->getModule() . '_edit', $this->userAbilities, true)) {

            return true;
        }

        return false;

    }


    /**
     * Change Status of an element
     */
    public function change()
    {

        if (in_array($this->getModule() . '_change', $this->userAbilities, true)) {

            return true;

        }
        return false;
    }

    /**
     * delete
     */
    public function delete()
    {

        if (in_array($this->getModule() . '_delete', $this->userAbilities, true)) {

            return true;

        }

        return false;
    }

    public function isAdmin()
    {
        if (\Cache::get('Module.Admin')) {
            return true;
        }

        return false;
    }

    public function isEditor()
    {

        if (\Cache::get('Module.Editor')) {
            return true;
        }
        return false;
    }

    public function isAuthor()
    {
        if (\Cache::get('Module.Author')) {
            return true;
        }
        return false;
    }
}