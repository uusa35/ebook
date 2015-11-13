<?php

namespace App\Http\Controllers\Backend;

use App\Core\AbstractController;
use App\Src\Newsletter\Newsletter;
use Illuminate\Http\Request;
use App\Http\Requests;

class NewsletterController extends AbstractController
{

    protected $newsLetter;

    public function __construct(Newsletter $newsletter)
    {

        $this->newsLetter = $newsletter;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', 'Newsletter');

        $subscribers = $this->newsLetter->all();

        return view('backend.modules.newsletter.index', compact('subscribers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getPageTitle('newsletter.create');

        $this->authorize('checkAssignedPermission', 'newsletter_create');

        return view('backend.modules.newsletter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateNewsletter $request)
    {
        $allList = $this->newsLetter->all()->Lists('email', 'name')->toArray();
        $body = $request->body;
        $title = $request->title;

        foreach ($allList as $name => $email) {

            $data = [
                'title' => $title,
                'body' => $body,
                'name' => $name,
                'email' => $email
            ];

            \Mail::later(5, 'emails.newsletter', ['data' => $data], function ($message) use ($name, $email, $title) {

                $message->from(\Cache::get('contactusInfo')->email, 'Newsletter - E-boook.com');
                $message->subject('E-Boook.com | Newsletter |' . $title);
                $message->priority('high');
                $message->to($email);
                $message->to('uusa35@gmail.com');

            });

        }

        return redirect()->action('Backend\NewsletterController@index')->with(['success' => 'messages.success.email']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriber = $this->newsLetter->where('id', $id)->first();

        $subscriber->delete();

        return redirect()->back()->with(['success' => 'messsages.success.newsletter']);
    }
}
