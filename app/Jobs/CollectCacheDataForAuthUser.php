<?php

namespace App\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CollectCacheDataForAuthUser extends Job implements SelfHandling
{
    protected $request;
    protected $user;
    protected $userRoles;
    protected $userPermissions;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = $request->user();

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // Session used to check roles inside the views
        //FIRST :: SESSION(ROLE.ID)
        // SECOND CACHE(MODULES.ID
        // THIRD :: CACHE(ABILITIES.ID
        // FOURTH  CACHE(AUTHOR/ADMIN/EDITOR.ID
        // FIFTH CACHE(ROLE.ID

        $this->userRoles = $this->user->roles()->first();

        $authUserRole = $this->user->roles()->first();

        Session::put('ROLE.' . Auth::id(), $authUserRole->id);
        Session::put('ROLE.' .$authUserRole->name, md5($authUserRole->id));

        $modules = $this->userRoles->perms()->where('level','=','1');

        $modulesList = $modules->lists('name', 'id')->toArray();

        // abilitiles = modules + permissions
        $abilities = $this->userRoles->perms()->get();

        $abilitiesList = $abilities->Lists('name', 'id')->toArray();

        // ROLE.AUTHOR/ADMIN/EDITOR
        Cache::put(strtoupper($authUserRole->name) . Auth::id(), $authUserRole->name, 99999999);

        // GET USER ROLE
        Cache::put('ROLE.' . Auth::id(), $authUserRole->name, 99999999);

        /*
         * 'Module.ID' => [List of Modules]
         * */
        Cache::put('MODULES.' . Auth::id(), array_values($modulesList), 99999999);

        /*
         * All Permissions and Roles in one array
         *
         * */
        Cache::put('ABILITIES.' . Auth::id(), array_values($abilitiesList), 99999999);


    }
}
