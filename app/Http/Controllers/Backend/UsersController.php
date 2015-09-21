<?php namespace App\Http\Controllers\Backend;

use App\Core\AbstractController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUser;
use App\Http\Requests\UpdateUser;
use App\Jobs\CreateImages;
use App\Jobs\CreateUserAvatar;
use App\Repositories\Criteria\User\UsersWithRoles;
use App\Src\Role\RoleRepository;
use App\Src\User\UserRepository;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use Mockery\CountValidator\Exception;

class UsersController extends AbstractController
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
        $users = $this->userRepository->model->with('roles')->get();
        return view('backend.modules.users.index', compact('users'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $this->getPageTitle('user.create');
        $roles = $this->roleRepository->model->all();
        return view('backend.modules.users.create', compact('roles'));
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateUser $request)
    {

        $request->merge(['active' , 1]);

        $user = $this->userRepository->model->create($request->all());

        if ($request->get('role')) {
            $user->roles()->sync($request->get('role'));
        } else {
            $user->roles()->sync([]);
        }
        return redirect()->action('Backend\UsersController@index')->with('sucess', 'User successfully created');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->getPageTitle('user.edit');

        $user = $this->userRepository->model->with('roles')->find($id);


        $userListRoleIds = $user->roles->Lists('name');

        $roles = $this->roleRepository->model->get();

        return view('backend.modules.users.edit', compact('user', 'roles', 'userListRoleIds'));
    }

    /**
     * @param $id
     * @param UpdateUserRequest $request
     */
    public function update(UpdateUser $request, $id)
    {

        $user = $this->userRepository->model->find($id);


        $user->update([
            'name_en' => $request->get('name_en'),
            'phone' => $request->get('phone'),
        ]);

        if ($request->hasFile('avatar')) {
            /*
            * Abstract CreateImages Job (Model , $request, FolderName, FieldsName , Default thumbnail sizes , Default large sizes
            * */
            $this->dispatch(new CreateImages($user, $request, 'avatar', ['avatar']));
        }


        if ($request->get('role')) {

            $user->roles()->sync($request->get('role'));

        } else {

            $user->roles()->sync([]);
        }

        return redirect()->action('Backend\UsersController@index')->with(['success' => trans('messages.success.user_edit')]);

    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);

        Flash::success('User successfully deleted');

        return redirect('/users');
    }

    public function postChangeActiveStatus($id, $status)
    {
        ($status === '0') ? $newStatus = 1 : $newStatus = 0;
        $user = $this->userRepository->model->find($id);
        $user->update([
            'active' => $newStatus
        ]);
        $user->save();
        return redirect()->action('Backend\UsersController@index')->with(['success' => trans('messages.sucess.change_active_status')]);
    }

}