<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 9/20/15
 * Time: 2:51 PM
 */

namespace App\Core;


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
    public $userPermissions;
    public $moduleRequested;
    public $permName;

    public function __construct()
    {
        $this->userRole = \Cache::get('role');
        $this->userPermissions = \Cache::get('Permission.' . $this->userRole);
        $this->moduleRequested = str_singular(strtolower(\Cache::get('module')));

    }


    public function create()
    {
        //dd($this->userPermissions);
        if (in_array($this->moduleRequested . '_create', $this->userPermissions, true)) {

            return true;
        }

        return false;
    }


    /**
     * @return bool
     */
    public function edit()
    {
        if (in_array($this->moduleRequested . '_edit', $this->userPermissions, true)) {

            return true;
        }

        return false;

    }


    /**
     * Change Status of an element
     */
    public function change()
    {

        if (in_array($this->moduleRequested. '_change', $this->userPermissions, true)) {

            return true;

        }
        return false;
    }

    /**
     * delete
     */
    public function delete()
    {

        if (in_array($this->moduleRequested.'_delete', $this->userPermissions, true)) {

            return true;

        }

        return false;
    }
}