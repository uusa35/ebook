<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

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

        //dd(Cache::get('Modules.Admin.'.Auth::id()));
        //dd(Cache::get('role.'.Auth::id()));
        //dd(Cache::get('Abilities.Author.'.Auth::id()));

        if (Session::has('roles')) {

            $authUserRole = $request->user()->roles()->first();

            Cache::put($authUserRole->name, $authUserRole->name, 120);

            $modules = $authUserRole->perms()->where('level', '=', '1')->get();

            $modulesList = $modules->lists('name', 'id')->toArray();

            $permissions = $authUserRole->perms()->where('level', '=', '2')->get();

            $permissionsList = $permissions->lists('name', 'id')->toArray();

            $abilities = $authUserRole->perms()->get();;

            $abilitiesList = $abilities->Lists('name', 'id')->toArray();


            /*
             * 'Module.Admin' => [List of Modules]
             * */
            Cache::put('Modules.' . $authUserRole->name.'.'.Auth::id(), array_values($modulesList), 120);

            //dd(Cache::get('Modules.Admin.'.Auth::id()));


            /*
             * 'Permission.Admin' => [List of Permissions]
             * */
            Cache::put('Permissions.' . $authUserRole->name.'.'.Auth::id(), array_values($permissionsList), 120);


            /*
             * All Permissions and Roles in one array
             *
             * */

            Cache::put('Abilities.' . $authUserRole->name.'.'.Auth::id(), array_values($abilitiesList), 120);

            /*
             * 'Permission.role_edit' => role_edit
             * */
            foreach ($permissions as $perm) {

                Cache::put('Permission.' . $perm->name.'.'.Auth::id(), $perm->name, 120);

            }

            // role.Admin = Admin
            Cache::put('role.' . $authUserRole->name.'.'.Auth::id(), $authUserRole->name, 120);

            // role.ID = Admin
            Cache::put('role.'.Auth::id(), $authUserRole->name, 120);

            Session::put('roles', \Crypt::encrypt(str_random(16)));



            return $next($request);

        } elseif (Cache::get('role.'.Auth::id()) && Session::get('roles')) {

            return $next($request);
        }

        dd('out of scope no session created and no cache created');
        //return redirect()->home()->with(['error' => 'messages.error.no_session']);

    }
}
