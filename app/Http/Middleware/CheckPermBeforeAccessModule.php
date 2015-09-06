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

        //$authUserRoles = $request->user()->roles()->first();

        //$AuthUserRolePerms = $authUserRoles->perms()->get()->lists('name')->toArray();

        //dd(\Crypt::decrypt(\Session::get('permission.Users')));

        //dd($perm);
        //dd(\Cache::get($perm));
        if (in_array($perm, [\Cache::get($perm)], true)) {

            return $next($request);
        }

        //Auth::logout();

        dd('blocked cookie here');
        /*return redirect('home')->with(['error' => 'messages.error.access_denied'])
            ->withCookie(Cookie::make('blocked', Crypt::encrypt('blocked'), '1'));*/

    }
}
