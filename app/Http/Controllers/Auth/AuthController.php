<?php

namespace App\Http\Controllers\Auth;

use App\Core\PrimaryController;
use App\Core\SocialAuthTrait;
use App\Events\SendRegisterationConfirmationEmail;
use App\Src\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends PrimaryController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins, SocialAuthTrait;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active' => 1,
            'level' => 3,
            'avatar' => 'avatar.png',
            'remember_token' => $data['_token']
        ]);

        if ($user) {

            $user->roles()->attach(3);

            event(new SendRegisterationConfirmationEmail($user));

            return $user;

        } else {

            abort('503');
        }

    }


    public function getLogout()
    {
        \Session::flush();

        if (Cache::get('role.' . Auth::id())) {
            Cache::get('Modules.' . $this->getUserRole() . '.' . Auth::id())->forget();
            Cache::get('Permissions.' . $this->getUserRole() . '.' . Auth::id())->forget();
            Cache::get('Abilities.' . $this->getUserRole() . '.' . Auth::id())->forget();
            Cache::get('role.' . $this->getUserRole() . '.' . Auth::id())->forget();
            Cache::get('role.' . Auth::id())->forget();
        }

        Auth::logout();
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }




}
