<?php

namespace App\Policies;

class RolesPolicy
{

    public $userRole;
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->userRole = \Cache::get('role');
        dd('from the constract of the RolesPolicies');
    }



    public function index () {
    return 'from index';
    }

    public function BeforeCreate() {
        return 'this is before create method from the Role Policy';
    }

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\User $user
     * @param  \App\Post $post
     * @return bool
     */
    public function update()
    {

        dd('test');

        $role = \Cache::get('role');
        dd(\Cache::get('Module.'.$role));
        if (in_array('role_update', \Cache::get('Permission.' . $role), true)) {
            return false;
        }
        return false;
    }
}
