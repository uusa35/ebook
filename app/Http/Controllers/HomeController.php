<?php namespace App\Http\Controllers;

use App\Core\PrimaryController;
use App\Core\PrimaryEmailService;
use App\Http\Requests\contactusSubmit;
use App\Http\Requests\PostNewsletter;
use App\Src\User\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class HomeController extends PrimaryController
{

    use PrimaryEmailService;

    public function getConditions()
    {

        return view('frontend.pages.conditions');

    }

    public function getContactus()
    {

        return view('frontend.partials.contactus');
    }


    public function sendContactUs(contactusSubmit $request)
    {
        $data = $request->all();

        $send = $this->sendEmailContactus($data);


        if ($send) {

            return redirect()->back()->with('success', trans('messages.success.contactus'));
        }


        return redirect()->back()->with('error', trans('messages.error.contactus'));
    }

    public function postNewsLetter(PostNewsletter $request)
    {

        $newsLetter = new \App\Src\Newsletter\Newsletter();

        $element = $newsLetter->where('email', $request->get('email'))->first();

        if ($element) {

            return redirect()->back()->with(['error' => 'messages.error.newsletter']);

        }

        $newsLetter->create($request->except('_token'));

        return redirect()->back()->with(['success' => 'messages.success.newsletter']);

    }



    /**
     * Confirm a user's email address.
     *
     * @param  string $token
     * @return mixed
     */
    public function confirmEmail($token)
    {
        $this->middleware('guest');

        $user = User::where('remember_token', $token)->firstOrFail();

        if (!$user) {

            dd('failure');

            session()->put('error', 'your account still not activated .. please check with the administrator');

            return redirect()->home();

        }

        $user->active = 1;

        $user->save();

        session()->flash('success', 'You are now confirmed. Please login.');

        return redirect()->home();
    }

}