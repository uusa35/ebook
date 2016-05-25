<?php namespace App\Http\Controllers\Backend;

use App\Core\PrimaryController;
use App\Src\Permission\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends PrimaryController
{

    public $perm;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Permission $permission)
    {
        $this->perm = $permission;
    }

    public function index()
    {
        

        if (Session::get('ROLE.' . Auth::id())) {

            $this->getPageTitle('dashboard.index');

            if ($this->isAuthor()) {

                $this->getCountersForAuthor();

                return view('backend.modules.user.dashboard.index');

            } elseif ($this->isAdmin() || $this->isEditor()) {

                $this->getCountersForAdminAndEditor();

                return view('backend.modules.user.dashboard.index');

            }

            return redirect()->back()->with(['error' => 'messeages.error.no_auth']);

        }

        return redirect()->back()->with(['error' => 'messeages.error.activate_your_account']);
    }

}
