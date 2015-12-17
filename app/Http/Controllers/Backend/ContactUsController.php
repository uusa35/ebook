<?php

namespace App\Http\Controllers\Backend;

use App\Core\PrimaryController;
use App\Src\Contactus\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactUsController extends PrimaryController
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

        $contactInfo = $this->contactus->first();

        \Cache::forever('contactusInfo', $contactInfo);

        return view('backend.modules.contactus.edit', ['contactInfo' => $contactInfo]);
    }

    public function update(Request $request)
    {

        $this->authorize('index',Session::get('module'));

        $this->contactus->update($request->except('_token'));

        return redirect()->back()->with('success', 'Contact Us Information has been updated');

    }
}
