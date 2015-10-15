<?php namespace App\Http\Controllers;

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


    public function sendContactUs(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required|max:255',
            'email'   => 'required|email',
            'subject' => 'required',
            'content' => 'required'
        ]);
        $data = $request->except('_token');
        Mail::later(2, 'emails.contactus', ['data' => $data], function ($message) {
            $message->from('test@test.com', 'Contact Us');
            $message->subject('Contact Us');
            $message->to('uusa35@gmail.com');
            /*->cc();*/
        });
        return redirect()->back()->with('success', trans('success-contactus'));
    }

}