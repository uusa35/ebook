<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 9/20/15
 * Time: 2:51 PM
 */

namespace App\Core;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class PoliciesCollection
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

    use UserTrait;

    public function __construct()
    {

    }


    public function getModule()
    {
        return $this->moduleRequested = str_singular(strtolower(\Session::get('module')));
    }


    public function index($module)
    {

        if (in_array($module, $this->getUserAbilities(), true)) {

            return true;
        }

        return false;

    }

    /**
     * Can Create = Can Store
     * @return bool
     */
    public function create($permission)
    {
        if (in_array($permission, $this->getUserAbilities(), true)) {

            return true;
        }

        return false;
    }


    /**
     * Can Edit = Can Update
     * @return bool
     */
    public function edit($ownerId)
    {

        if (in_array($this->getModule() . '_edit', $this->getUserAbilities(), true)) {

            if ($this->isAuthor()) {

                if (Auth::id() == $ownerId) {

                    return true;

                }
                return false;
            }

            return true;

        }
        return false;

    }


    /**
     * Change Status of an element
     */
    public function change($ownerId)
    {
        if (in_array($this->getModule() . '_change', $this->getUserAbilities(), true)) {

            if ($this->isAuthor()) {

                if (Auth::id() == $ownerId) {

                    return true;

                }
                return false;
            }

            return true;

        }
        return false;
    }

    /**
     * delete
     */
    public function delete($ownerId)
    {
        if (in_array($this->getModule() . '_delete', $this->getUserAbilities(), true)) {

            if ($this->isAdmin()) {

                return true;

            } elseif (Auth::id() === $ownerId->id) {

                return true;
            }

            return false;
        }

        return false;
    }


    public function checkAssignedPermission($permission)
    {
        if (in_array($permission, $this->getUserAbilities(), true)) {

            return true;
        }

        return false;
    }

}