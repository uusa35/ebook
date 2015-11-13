<?php namespace App\Http\Controllers;

use App\Http\Requests\contactusSubmit;
use App\Http\Requests\PostNewsletter;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

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

        //$data = $request->except('_token');

        $data = $request->all();

        $send = Mail::send('emails.contactus', ['data' => $data], function ($message) use ($data) {

            $message->from('uusa35@gmail.com', 'Contact Us');
            $message->subject('E-Boook.com | Contact Us |' . $data['subject']);
            $message->priority('high');
            $message->to(\Cache::get('contactusInfo')->email);
            $message->to('usama.ahmed@live.com');

        });

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

            dd('from inside if');

            return redirect()->back()->with(['error' => 'messages.error.newsletter']);

        }

        $newsLetter->create($request->except('_token'));

        return redirect()->back()->with(['success' => 'messages.success.newsletter']);

    }

}