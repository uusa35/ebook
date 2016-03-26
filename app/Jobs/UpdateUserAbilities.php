<?php

namespace App\Jobs;

use Illuminate\Http\Request;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class UpdateUserAbilities extends Job implements SelfHandling
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

        $userRole = $this->request->user()->roles()->first();

        Session::put('ROLE.'.Auth::id(),$userRole->id);

        Cache::get('ROLE.'.Auth::id(),$userRole->name,9999999);

        $modules = $userRole->perms()->where('level', '=', '1')->get();

        $modulesList = $modules->lists('name', 'id')->toArray();

        Cache::put('MODULES.'. Auth::id(), array_values($modulesList), 9999999);

        $userAbilities = $userRole->perms()->get()->lists('name','id')->toArray();

        Cache::put('ABILITIES.'. Auth::id(), array_values($userAbilities), 9999999);

    }
}
