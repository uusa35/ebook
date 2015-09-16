<?php namespace App\Http\Controllers\Backend;

use App\Core\AbstractController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends AbstractController
{


    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    public $authUserRoles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
        //$this->middleware('auth', ['only' => 'logged']);
        $this->titles = [
            'index' => trans('word.general.dashboard')
        ];
        //$roles = $this->authUserRoles = Auth::user()->roles()->get();

    }

    public function index()
    {
        if (\Cache::has('roles')) {
            $this->getPageTitle('index');
            return view('backend.modules.users.dashboard.index');
        }
        Auth::logout();
        return redirect()->back()->with(['error' => 'messeages.error.roles_sessions_not_created']);
    }

}
