<?php

namespace App\Http\Controllers;

use App\Core\PrimaryController;
use App\Src\User\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class RegistrationController extends PrimaryController
{
    /**
     * Create a new registration instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Confirm a user's email address.
     *
     * @param  string $token
     * @return mixed
     */
    public function confirmEmail($token)
    {
        $user = User::where('remember_token', $token)->firstOrFail();

        if (!$user) {

            session()->put('error', 'your account still not activated .. please check with the administrator');

            return redirect()->home();

        }

        $user->active = 1;

        $user->save();

        session()->flash('success', 'You are now confirmed. Please login.');
        
        return redirect('login');
    }
}
