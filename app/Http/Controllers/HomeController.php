<?php namespace App\Http\Controllers;

use App\Http\Requests\contactusSubmit;
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

        $data = $request->except('_token');

        $send =  Mail::send('emails.test', ['data' => $data], function ($message) use ($data){
            $message->from('uusa35@gmail.com', 'Contact Us');
            $message->subject('E-Boook.com | Contact Us |'.$data['subject']);
            $message->to('usama.ahmed@live.com');
            $message->cc('uusa35@gmail.com');
            $message->cc($data['email']);

        });


        if($send) {
            return redirect()->back()->with('success', trans('messages.success.contactus'));
        }


        return redirect()->back()->with('error', trans('messages.error.contactus'));
    }

}