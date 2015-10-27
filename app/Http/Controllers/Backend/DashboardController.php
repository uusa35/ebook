<?php namespace App\Http\Controllers\Backend;

use App\Core\AbstractController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends AbstractController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
        //$this->middleware('auth', ['only' => 'logged']);
        //$roles = $this->authUserRoles = Auth::user()->roles()->get();

    }

    public function index()
    {
        if (Session::has('roles')) {

            $this->getPageTitle('dashboard.index');

            if ($this->getUserRole()) {

                return view('backend.modules.user.dashboard.index');

            }
        }

        Auth::logout();

        return redirect()->back()->with(['error' => 'messeages.error.no_auth']);
    }

}
