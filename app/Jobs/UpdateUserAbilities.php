<?php

namespace App\Jobs;

use Illuminate\Http\Request;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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

        $modules = $userRole->perms()->where('level', '=', '1')->get();

        $modulesList = $modules->lists('name', 'id')->toArray();

        Cache::put('Modules.' . $userRole->name . '.' . Auth::id(), array_values($modulesList), 120);

        $userPermissions = $userRole->perms()->get()->lists('name','id')->toArray();

        Cache::put('Abilities.' . $userRole->name . '.' . Auth::id(), array_values($userPermissions), 120);
    }
}
