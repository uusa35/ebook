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

        $routeName = explode('.', \Route::currentRouteName(), 3);

        if (count($routeName) > 1) {
            \Session::put('module', ucfirst($routeName[1]));
        }

        //$permName = $routeName[2];
        $role = \Cache::get('role');
        $array = (\Cache::get('Module.' . $role));
        //dd($array);

        //dd(\Session::get('module'));

        if (in_array(\Session::get('module'), $array, true)) {

            return $next($request);
        }

        //Auth::logout();

        dd('blocked cookie here');
        /*return redirect('home')->with(['error' => 'messages.error.access_denied'])
            ->withCookie(Cookie::make('blocked', Crypt::encrypt('blocked'), '1'));*/

    }
}
