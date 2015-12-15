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
        if (!Session::has('roles')) {

            $this->dispatch(new CollectCacheDataForAuthUser($request));

            Session::put('roles', \Crypt::encrypt(str_random(16)));

            return $next($request);

        } elseif (Cache::get('role.' . Auth::id()) && Session::get('roles')) {

            return $next($request);
        } else {
            Session::flush();
            Auth::logout();
            return $next($request);
        }

    }
}
