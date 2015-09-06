<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class AfterUserLoginActiveCheck
{
    /**
     * if a user is deactivated by admin
     * can not access any route that is under auth middleware
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Cookie::get('blocked') &&  Cookie::get('blocked') === Crypt::decrypt(Cookie::get('blocked'))) {

            return redirect('home')->with(['error' => 'messages.error.not_active']);

        }

        $user = Auth::user();

        if ($user->active === '1') {

            return $next($request);
        }

        Auth::logout();

        return redirect('home')->with(['error' => 'messages.error.not_active'])
            ->withCookie(Cookie::make('blocked', Crypt::encrypt('blocked'), '12000'));


    }
}
