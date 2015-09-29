<?php

namespace App\Http\Controllers\Backend;

use App\Src\Contactus\Contactus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactUsController extends Controller
{
    //
    public $contactus;

    public function __construct(Contactus $contactus)
    {
        $this->contactus = $contactus;
    }

    public function index() {

        //Cache::forget('contactusInfo');

        $contactInfo = $this->contactus->first();

        return view('backend.modules.contactus.edit', ['contactInfo' => $contactInfo]);
    }

    public function edit()
    {

        //Cache::forget('contactusInfo');

        $contactInfo = $this->contactus->first();

        return view('backend.modules.contactus.edit', ['contactInfo' => $contactInfo]);
    }

    public function update(Request $request)
    {

        $this->contactus->update($request->except('_token'));

        return redirect()->back()->with('success', 'Contact Us Information has been updated');

    }
}
