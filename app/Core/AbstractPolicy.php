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

    use UserTrait;

    public function __construct()
    {
        $this->userRole = Cache::get('role');
        $this->userAbilities = Cache::get('Abilities.' . $this->userRole.'.'.Auth::id());


    }

    public function getModule()
    {
        return $this->moduleRequested = str_singular(strtolower(\Session::get('module')));
    }


    /**
     * Can Create = Can Store
     * @return bool
     */
    public function create()
    {
        if (is_null($this->userAbilities)) {

            return redirect()->to('dashboard');

        }

        if (in_array($this->getModule() . '_create', $this->userAbilities, true)) {

            return true;
        }

        return false;
    }


    /**
     * Can Edit = Can Update
     * @return bool
     */
    public function edit($owner = '')
    {
        if (is_null($this->userAbilities)) {

            return redirect()->to('dashboard');

        }

        if (in_array($this->getModule() . '_edit', $this->userAbilities, true)) {

            if ($this->isAdmin() || $this->isEditor()) {

                return true;
            }

            elseif ($this->isAuthor()) {

                return true;
            }

            return false;

        }

        return false;

    }


    /**
     * Change Status of an element
     */
    public function change($owner = '')
    {

        if (is_null($this->userAbilities)) {

            return redirect()->to('dashboard');

        }

        if (in_array($this->getModule() . '_change', $this->userAbilities, true)) {

            if ($this->isAuthor()) {

                if (\Auth::id() === $owner) {

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
    public function delete()
    {

        if (is_null($this->userAbilities)) {

            return redirect()->to('dashboard');

        }

        if (in_array($this->getModule() . '_delete', $this->userAbilities, true)) {

            if ($this->isAuthor()) {

                if (\Auth::id() === $owner) {

                    return true;

                }
                return false;
            }

            return true;

        }

        return false;
    }

}