<?php namespace App\Http\Controllers\Backend;

use App\Core\AbstractController;
use App\Src\Role\RoleRepository;
use App\Src\Permission\PermissionRepository;
use App\Src\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RolesController extends AbstractController
{

    private $roleRepository;
    private $permissionRepository;
    private $userRepository;


    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository,
        UserRepository $userRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
        $this->userRepository = $userRepository;

    }

    public function index()
    {
        //$roles = $this->role->pushCriteria(new RolesWithPermissions())->paginate(10);
        $this->getPageTitle('role.index');
        $roles = $this->roleRepository->model->with('users', 'perms')->get();

        return view('backend.modules.roles.index', compact('roles'));
    }

    public function create()
    {
        $this->getPageTitle('role.create');

        $permissions = $this->permissionRepository->model->all();

        return view('backend.modules.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {

        $this->validate($request,
            array('name' => 'required|unique:roles,name', 'display_name' => 'required|unique:roles,display_name'));


        $role = $this->roleRepository->model->create($request->all());

        $role->savePermissions($request->get('perms'));

        return redirect()->action('Backend\RolesController@index')->with(['success' => trans('messages.success.role_create')]);
    }

    public function edit($id)
    {
        $this->getPageTitle('role.edit');

        $role = $this->roleRepository->model->find($id);

        $permissions = $this->permissionRepository->model->all();

        $rolePerms = $role->perms()->lists('name', 'id');

        return view('backend.modules.roles.edit', compact('role', 'permissions', 'rolePerms'));
    }

    public function update(Request $request, $id)
    {

        if (Gate::allows('edit')) {

            $this->validate($request, array('name' => 'required', 'display_name' => 'required'));

            $role = $this->roleRepository->model->find($id);

            $role->update($request->all());

            $role->savePermissions($request->get('perms'));

            return redirect()->action('Backend\RolesController@index')->with(['success' => 'messeages.success.role_edit']);
        }

        return redirect()->action('Backend\RolesController@index')->with(['error' => 'messeages.error.role_edit']);

    }

    public function destroy($id)
    {

        $role = $this->roleRepository->model->find($id);

        $role->delete();
        $role->users()->sync([]); // Delete relationship data
        $role->perms()->sync([]);


        return redirect()->action('Backend\RolesController@index')->with(['success' => trans('messages.success.role_delete')]);
    }

}