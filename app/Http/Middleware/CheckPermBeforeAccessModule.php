<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Crypt;


class CheckPermBeforeAccessModule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $perm)
    {

        // Cached within the Middleware CollectData for a authenticated user

        //dd(\Cache::get('permission_Roles'));

        if (in_array($perm, [\Cache::get('permission_'.$perm)], true)) {

            return $next($request);
        }

        //Auth::logout();

        dd('blocked cookie here');
        /*return redirect('home')->with(['error' => 'messages.error.access_denied'])
            ->withCookie(Cookie::make('blocked', Crypt::encrypt('blocked'), '1'));*/

    }
}
