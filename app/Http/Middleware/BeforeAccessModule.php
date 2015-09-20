<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Crypt;


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

        $requestedRouteName = explode('.', \Route::currentRouteName(), 3);

        if (count($requestedRouteName) > 1 && $requestedRouteName[2] === 'index') {

            $moduleEncrypted = \Crypt::encrypt(ucfirst($requestedRouteName[1]));

            $moduleDecrypted = \Crypt::decrypt($moduleEncrypted);

            \Session::put('module', $moduleEncrypted);

            $role = \Cache::get('role');

            $array = (\Cache::get('Module.' . $role));

            if (in_array($moduleDecrypted, $array, true)) {

                return $next($request);

            }
            dd('blocked cookie here');
        }

        /*
         * to the next level which is permission middleware
         * */
        return $next($request);


    }
}
