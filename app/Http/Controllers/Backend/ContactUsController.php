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

        $this->authorize('authorizeAccess','contactus');

        $contactInfo = $this->contactus->first();

        return view('backend.modules.contactus.edit', ['contactInfo' => $contactInfo]);
    }

    public function edit()
    {
        $this->authorize('authorizeAccess','contactus');

        $this->getPageTitle('dashboard.contactus');

        $contactInfo = $this->contactus->first();

        return view('backend.modules.contactus.edit', ['contactInfo' => $contactInfo]);
    }

    public function update(Request $request)
    {

        $this->authorize('authorizeAccess','contactus');

        $this->contactus->update($request->except('_token'));

        $contactInfo = $this->contactus->first();

        \Cache::forget('contactusInfo');

        \Cache::forever('contactusInfo', $contactInfo);

        return redirect()->back()->with('success', 'Contact Us Information has been updated');

    }
}
