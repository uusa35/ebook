<?php namespace App\Http\Controllers\Backend;

use App\Core\PrimaryController;
use App\Http\Requests\CreateUser;
use App\Http\Requests\EditUser;
use App\Http\Requests\UpdateUser;
use App\Jobs\CreateImages;
use App\Src\Role\RoleRepository;
use App\Src\User\UserRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class UsersController extends PrimaryController
{

    /**
     * @var User
     */
    protected $userRepository;
    protected $roleRepository;

    /**
     * @param User $user
     * @param Role $role
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $this->getPageTitle('user.index');

        $this->authorize('index', Session::get('module'));

        $users = $this->userRepository->model->with('roles')->get();
        return view('backend.modules.user.index', compact('users'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $this->authorize('create', 'user_create');

        $this->getPageTitle('user.create');

        $roles = $this->roleRepository->model->all();

        return view('backend.modules.user.create', compact('roles'));

    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateUser $request)
    {

        $request->merge(['active' => 1, 'level' => 3]);

        $user = $this->userRepository->model->create($request->all());

        $this->authorize('create', 'user_create');

        if ($request->get('role')) {

            $user->roles()->sync($request->get('role'));

        } else {

            $user->roles()->sync([]);

        }
        return redirect()->action('Backend\UsersController@index')->with(['sucess', 'User successfully created']);

    }

    /**
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {

        $this->getPageTitle('user.edit');

        Session::put('module', 'Users');

        $this->authorize('edit', $id);

        $user = $this->userRepository->model->with('roles')->find($id);

        $userListRoleIds = $user->roles->Lists('name');

        $roles = $this->roleRepository->model->get();

        return view('backend.modules.user.edit', compact('user', 'roles', 'userListRoleIds'));
    }

    /**
     * @param $id
     * @param UpdateUserRequest $request
     */
    public function update(UpdateUser $request, $id)
    {

        $user = $this->userRepository->model->find($id);

        $user->update($request->all());

        $user->save();

        Session::put('module', 'Users');

        $this->authorize('edit', $id);


        $user->fill($request->all());

        if ($request->hasFile('avatar')) {
            /*
            * Abstract CreateImages Job (Model , $request, FolderName, FieldsName , Default thumbnail sizes , Default large sizes
            * */
            $this->dispatch(new CreateImages($user, $request, 'avatar', ['avatar']));
        }


        if ($request->get('role')) {

            $user->roles()->sync($request->get('role'));
            $user->level = $request->get('role')[0];
            $user->save();

        }

        if ($this->isAuthor()) {

            Session::forget('module');

            return redirect()->action('Backend\DashboardController@index')->with(['success' => trans('messages.success.edited')]);
        }

        return redirect()->action('Backend\UsersController@index')->with(['success' => trans('messages.success.edited')]);

    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $this->authorize('checkAssignedPermission', 'user_delete');

        $this->userRepository->delete($id);

        return redirect('/users')->with(['success', 'messages.success.deleted']);
    }

    public function postChangeActiveStatus($id, $status)
    {
        $this->authorize('checkAssignedPermission', 'user_change');

        ($status == '0') ? $newStatus = 1 : $newStatus = 0;

        $user = $this->userRepository->model->find($id);

        $user->update([
            'active' => $newStatus
        ]);

        $user->save();

        return redirect()->action('Backend\UsersController@index')->with(['success' => trans('messages.sucess.updated')]);
    }

    public function getEditConditions()
    {
        $this->authorize('checkAssignedPermission', 'condition_edit');

        $terms = DB::table('conditions')->first();

        return view('backend.modules.user.conditions', ['terms' => $terms]);
    }

    public function postEditConditions()
    {
        $this->authorize('checkAssignedPermission', 'condition_edit');

        $instructions = DB::table('conditions')->update([
            'title_ar' => Input::get('title_ar'),
            'title_en' => Input::get('title_en'),
            'body_ar' => Input::get('body_ar'),
            'body_en' => Input::get('body_en'),
        ]);

        if ($instructions) {

            $instructions = DB::table('conditions')->first();

            Cache::forever('conditions', $instructions);

            return redirect()->back()->with(['success' => trans('general.success.updated')]);
        }

        return redirect()->back()->with(['success' => trans('general.error.updated')]);
    }

}