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
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $authUserRoles = $request->user()->roles()->get();

        //\Session::flush();

        //dd(\Cache::get('role'));

        if (!\Cache::has('role')) {


            foreach ($authUserRoles as $role) {

                \Session::put('role', str_random(16));

                \Cache::put('role', str_random(16), 1);

                $AuthUserRolePerms = $role->perms()->get()->lists('name')->toArray();

                \Cache::put($role->name, $AuthUserRolePerms, 1);



                foreach ($AuthUserRolePerms as $perm) {

                    \Session::put('permission.' . $perm, \Crypt::encrypt($perm));

                    \Cache::put($perm, $perm, 1);

                }

                \Session::put('role.' . $role->name, \Crypt::encrypt($role->display_name));

                \Cache::put('role', $role->name, 1);

            }


        }

        //     dd(\Session::all());

        return $next($request);
    }
}
