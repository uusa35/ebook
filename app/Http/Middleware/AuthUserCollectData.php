<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class AuthUserCollectData
{

    public function __construct()
    {

    }

    /**
     *
     * Only Checks for the role of a user
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {




        if (!\Cache::has('roles')) {

        $authUserRoles = $request->user()->roles()->get();

            foreach ($authUserRoles as $role) {

                \Session::put('roles', str_random(16));

                // roles => 'rand'
                \Cache::put('roles', str_random(16), 1);

                $AuthUserRolePerms = $role->perms()->where('level', '=', '1')->get()->lists('name')->toArray();

                $AuthUserRolePermsWithLevels = $role->perms()->get(['name', 'level']);

                foreach ($AuthUserRolePermsWithLevels as $perm) {

                    // level_create_user , 2
                    \Cache::put('level_' . $perm->name, $perm->level, 0);

                    // permission_create_user , create_user
                    \Cache::put('permission_' . $perm->name, $perm->name, 0);

                }

                \Session::put('role.' . $role->name, \Crypt::encrypt($role->display_name));

                // 'Modules_Admin' => 'Users', 'Books' ....

                \Cache::put('Modules_'.$role->name, $AuthUserRolePerms, 0);

                //dd(\Cache::get('Modules_Admin'));

            }


        }

        return $next($request);
    }
}
