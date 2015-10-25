<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class AuthUserCollectData
{
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

        if (is_null(\Session::get('roles'))) {

            $authUserRole = $request->user()->roles()->first();

            \Cache::put($authUserRole->name, $authUserRole->name, 120);

            $modules = $authUserRole->perms()->where('level', '=', '1')->get();

            $modulesList = $modules->lists('name', 'id')->toArray();

            $permissions = $authUserRole->perms()->where('level', '=', '2')->get();

            $permissionsList = $permissions->lists('name', 'id')->toArray();

            $abilities = $authUserRole->perms()->get();;

            $abilitiesList = $abilities->Lists('name', 'id')->toArray();


            /*
             * 'Module.Admin' => [List of Modules]
             * */
            \Cache::put('Module.' . $authUserRole->name, array_values($modulesList), 120);


            /*
             * 'Permission.Admin' => [List of Permissions]
             * */
            \Cache::put('Permission.' . $authUserRole->name, array_values($permissionsList), 120);


            /*
             * All Permissions and Roles in one array
             *
             * */

            \Cache::put('Abilities.' . $authUserRole->name, array_values($abilitiesList), 120);


            /*
             * 'Permission.role_edit' => role_edit
             * */
            foreach ($permissions as $perm) {

                \Cache::put('Permission.' . $perm->name, $perm->name, 120);

            }


            \Session::put('roles', \Crypt::encrypt(str_random(16)));

            // roles => 'rand'
            // role = Admin
            \Cache::put('role', $authUserRole->name, 120);

            // role.Admin = Admin
            \Cache::put('role.' . $authUserRole->name, $authUserRole->name, 120);

            return $next($request);

        } elseif (\Cache::get('role') && \Session::get('roles')) {

            return $next($request);
        }

        \Session::clear();
        \Auth::logout();

        return redirect('/');
        //dd('no cache found');
    }
}
