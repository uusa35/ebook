<?php

namespace App\Http\Controllers\Auth;

use App\Core\AbstractController;
use App\Src\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Facades\Socialite;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends AbstractController
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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

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
            'name_en' => 'required|max:255',
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
        return User::create([
            'name_en' => $data['name_en'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active' => 1,
        ]);
    }


    public function getLogout()
    {

        \Session::flush();
        \Cache::flush();
        \Auth::logout();
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }


    public function redirectToProvider()
    {
        return \Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {

        $userSocilite = \Socialite::driver('facebook')->user();

        $data = [
            'name_en' => $userSocilite->name,
            'email' => $userSocilite->email,
            'password' => $userSocilite->token
        ];

        $user = User::where('email', '=', $userSocilite->email)->first();

        if ($user) {

           \ Auth::login($user);

            return redirect('home');

        } else {

            \Auth::login(User::create($data));

        }

        redirect('home');

    }

}
