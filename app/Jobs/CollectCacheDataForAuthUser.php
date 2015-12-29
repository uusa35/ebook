<?php

namespace App\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CollectCacheDataForAuthUser extends Job implements SelfHandling
{
    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $authUserRole = $this->request->user()->roles()->first();

        // Session used to check roles inside the views
        Session::put($authUserRole->name, \Crypt::encrypt(Auth::id()));

        if (is_null(Cache::get('Permissions.' . $authUserRole->name . '.' . Auth::id()))) {

            Cache::put($authUserRole->name, $authUserRole->name, 120);

            $modules = $authUserRole->perms()->where('level', '=', '1')->get();

            $modulesList = $modules->lists('name', 'id')->toArray();

            $permissions = $authUserRole->perms()->where('level', '=', '2')->get();

            $permissionsList = $permissions->lists('name', 'id')->toArray();

            $abilities = $authUserRole->perms()->get();

            $abilitiesList = $abilities->Lists('name', 'id')->toArray();


            /*
             * 'Module.Admin' => [List of Modules]
             * */
            Cache::put('Modules.' . $authUserRole->name . '.' . Auth::id(), array_values($modulesList), 120);

            //dd(Cache::get('Modules.Admin.'.Auth::id()));


            /*
             * 'Permission.Admin' => [List of Permissions]
             * */
            Cache::put('Permissions.' . $authUserRole->name . '.' . Auth::id(), array_values($permissionsList), 120);


            /*
             * All Permissions and Roles in one array
             *
             * */

            Cache::put('Abilities.' . $authUserRole->name . '.' . Auth::id(), array_values($abilitiesList), 120);

            /*
             * 'Permission.role_edit' => role_edit
             * */
            foreach ($permissions as $perm) {

                Cache::put('Permission.' . $perm->name . '.' . Auth::id(), $perm->name, 120);

            }

            // role.Admin = Admin
            Cache::put('role.' . $authUserRole->name . '.' . Auth::id(), $authUserRole->name, 120);

            // role.ID = Admin
            Cache::put('role.' . Auth::id(), $authUserRole->name, 120);
        }

    }
}
