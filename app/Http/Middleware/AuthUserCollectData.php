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


        if (!\Cache::has('role')) {

            $authUserRole = $request->user()->roles()->first();

            \Cache::put($authUserRole->name, $authUserRole->name, 0);

            $modules = $authUserRole->perms()->where('level', '=', '1')->get();

            $modulesList = $modules->lists('name', 'id')->toArray();

            $permissions = $authUserRole->perms()->where('level', '=', '2')->get();

            $permissionsList = $permissions->lists('name', 'id')->toArray();
            /*
             * 'Module.Admin' => [List of Modules]
             * */
            //dd(array_values($modulesList));
            \Cache::put('Module.' . $authUserRole->name, array_values($modulesList), 0);


            /*
             * 'Permission.user_edit' => [List of Permissions]
             * */
            \Cache::put('Permission.' . $authUserRole->name, array_values($permissionsList), 0);


            \Session::put('roles', str_random(16));

            // roles => 'rand'
            // role = Admin
            \Cache::put('role',$authUserRole->name, 1);
            // role.Admin = Admin
            \Cache::put('role.'.$authUserRole->name,$authUserRole->name, 1);

        }


        return $next($request);
    }
}
