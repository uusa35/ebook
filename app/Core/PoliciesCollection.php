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

class PoliciesCollection
{
//    /*
//     * 1- Abstract Policy created
//     * 2- get the role of a user from the cache
//     * 3- get the all permissions from the cache
//     * 4- search in the array of permissions if the requested link is granted access for each method CRUD
//     * 5- One Case Example : you can not add chapter unless you have access to edit the book itself.
//     * */


    use UserTrait;

    /**
     * Can Edit = Can Update
     * @return bool
     */
    public function authorizeAccess($module)
    {
//        var_dump($this->getUserAbilities());
//        var_dump(ucfirst($module));
        if (in_array($module, $this->getUserAbilities(), true)) {

            return true;
        }

        return false;

    }

    public function authorizeOwnership($ownerId)
    {

        if ($this->isAuthor()) {


            if (Auth::id() == $ownerId) {

                return true;

            }

            return false;
        }
        
        return true;
    }
}