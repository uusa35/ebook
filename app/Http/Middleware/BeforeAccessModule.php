<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
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

        $requestedRouteName = explode('.', Route::currentRouteName(), 3);

        /*
         * Only cheds if there is index within the route
         * */
        if (count($requestedRouteName) > 1 && in_array('index',$requestedRouteName,true)) {

            Session::remove('module');

            $this->nextRequest($requestedRouteName);

            return $next($request);

        }
        /*
         * out of scope for index
         * */
        return $next($request);

    }

    public function nextRequest($requestedRouteName)
    {
        $moduleEncrypted = Crypt::encrypt(ucfirst($requestedRouteName[1]));

        $moduleDecrypted = Crypt::decrypt($moduleEncrypted);

        //\Cache::put('module', $moduleDecrypted, 120);

        $role = Cache::get('role.'.Auth::id());

        $array = \Cache::get('Abilities.'.$role.'.'.Auth::id());

        //dd($array);
        //dd($moduleDecrypted);

        if (in_array($moduleDecrypted, $array, true)) {

            return Session::put('module', $moduleDecrypted);
        }

        return Auth::logout();

        dd('out of scope from inside the nextRequest funciton');
    }
}
