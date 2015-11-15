<?php

namespace App\Http\Controllers\Backend;

use App\Core\AbstractController;
use App\Src\Contactus\Contactus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ContactUsController extends AbstractController
{
    //
    public $contactus;

    public function __construct(Contactus $contactus)
    {
        $this->contactus = $contactus;
    }

    public function index() {

        $this->authorize('index',Session::get('module'));

        $contactInfo = $this->contactus->first();

        return view('backend.modules.contactus.edit', ['contactInfo' => $contactInfo]);
    }

    public function edit()
    {
        $this->authorize('index',Session::get('module'));

        $this->getPageTitle('dashboard.contactus');
        //Cache::forget('contactusInfo');

        $contactInfo = $this->contactus->first();

        \Cache::put('contactusInfo', $contactInfo, 1440);

        return view('backend.modules.contactus.edit', ['contactInfo' => $contactInfo]);
    }

    public function update(Request $request)
    {

        $this->authorize('index',Session::get('module'));

        $this->contactus->update($request->except('_token'));

        return redirect()->back()->with('success', 'Contact Us Information has been updated');

    }
}
