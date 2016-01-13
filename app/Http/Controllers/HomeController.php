<?php namespace App\Http\Controllers;

use App\Core\PrimaryController;
use App\Core\PrimaryEmailService;
use App\Http\Requests\contactusSubmit;
use App\Http\Requests\PostNewsletter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class HomeController extends PrimaryController
{

    use PrimaryEmailService;

    public function index()
    {
        //\Session::flush();
        return view('frontend.modules.book.index');
    }


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

//        $request->merge(['youtube' => Cache::get('contactusInfo')->youtube,'twitter' => Cache::get('contactusInfo')->twitter,'instagram' => Cache::get('contactusInfo')->instagram]);

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

}