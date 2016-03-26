<?php

namespace App\Http\Middleware;

use App\Jobs\CollectCacheDataForAuthUser;
use Closure;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AfterUserLoginCollectData
{
    use DispatchesJobs;

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


        // IF THERE IS NO ROLE SESSION

        if(!Session::get('ROLE.'.Auth::id())) {

            $activeUser = Auth::user()->active;

            if($activeUser) {
                /*
                 * GATHER ALL INFO ABOUT THE USER WITHIN THE CACHE
                 * */

                $this->dispatch(new CollectCacheDataForAuthUser($request));

                return $next($request);
            }

            // IN CASE THE USER IS NOT ACTIVE

            Cache::forget('ROLE.'.Auth::id());
            Cache::forget('MODULES.'.Auth::id());
            Cache::forget('ABILITIES.'.Auth::id());

            Session::flush();

            Auth::logout();

            return $next($request);


        }

        return $next($request);

    }
}
