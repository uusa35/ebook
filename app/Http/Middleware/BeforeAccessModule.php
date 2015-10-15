<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use \Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;


class BeforeAccessModule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // Cached within the Middleware CollectData for a authenticated user
        /*
         *
         * 1- get the Route Name then make sure it's the Index of the Module
         * 2- to make sure the Module is stored within the cache and assigned to the current authenticated user
         * */


        Session::remove('module');

        $requestedRouteName = explode('.', Route::currentRouteName(), 3);

        //dd($requestedRouteName);
        //dd(\Cache::get('Module.Admin'));

        if (count($requestedRouteName) > 1 && $requestedRouteName[2] === 'index') {

            $this->nextRequest($requestedRouteName);

            return $next($request);


        } elseif ($requestedRouteName[0] === 'backend' && count($requestedRouteName[0]) >= 1) {

            $this->nextRequest($requestedRouteName);

            return $next($request);

        }
        /*
         * out of scope
         * */

        return $next($request);

    }

    public function nextRequest($requestedRouteName)
    {
        $moduleEncrypted = Crypt::encrypt(ucfirst($requestedRouteName[1]));

        $moduleDecrypted = Crypt::decrypt($moduleEncrypted);

        //\Cache::put('module', $moduleDecrypted, 120);

        $role = Cache::get('role');

        $array = \Cache::get('Abilities.'.$role);

        //dd($array);
        //dd($moduleDecrypted);

        if (in_array($moduleDecrypted, $array, true)) {

            return Session::put('module', $moduleDecrypted);
        }

        dd('out of scope from inside the nextRequest funciton');
    }
}
