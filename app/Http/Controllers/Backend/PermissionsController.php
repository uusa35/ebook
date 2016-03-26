<?php namespace App\Http\Controllers\Backend;

use App\Core\PrimaryController;
use App\Src\Permission\PermissionRepository;
use App\Src\Role\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PermissionsController extends PrimaryController
{

    private $roleRepository;
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository, RoleRepository $roleRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $this->getPageTitle('permission.index');

        $this->authorize('authorizeAccess', 'permissions');

        $permissions = $this->permissionRepository->model->all();

        return view('backend.modules.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $this->getPageTitle('permission.create');

        $this->authorize('authorizeAccess', 'permission_create');

        return view('backend.modules.permissions.create');
    }

    public function store(Request $request)
    {
        $this->authorize('authorizeAccess', 'permission_create');

        $this->validate($request, array(
            'name' => 'required|unique:permissions,name',
            'display_name' => 'required|unique:permissions,display_name',
            'level' => 'required'
        ));

        $permission = $this->permissionRepository->model->create($request->all());

        $role = $this->roleRepository->model->where('name', '=', 'Admin')->first();

        $role->perms()->sync([$permission->id], false);

        return redirect()->action('Backend\PermissionsController@index')->with('success', trans('messages.success.created'));
    }

    public function edit($id)
    {
        $this->getPageTitle('permission.edit');

        $this->isAdmin();

        $this->authorize('authorizeAccess', 'permission_edit');

        $permission = $this->permissionRepository->model->find($id);

        return view('backend.modules.permissions.edit', compact('permission'));
    }


    public function update(Request $request, $id)
    {
        $this->authorize('authorizeAccess', 'permission_edit');

        $this->validate($request, array('name' => 'required', 'display_name' => 'required'));

        $permission = $this->permissionRepository->model->find($id);

        $permission->update($request->all());

        $permission->save();

        return redirect()->action('Backend\PermissionsController@index')->with('success', trans('messages.success.updated'));
    }

    public function destroy($id)
    {
        $this->authorize('authorizeAccess', 'permission_delete');

        $permission = $this->permissionRepository->model->where('id', '=', $id)->first();

        $role = $this->roleRepository->model->where('name', '=', 'Admin')->first();

        $role->perms()->sync([$permission->id], false);

        if ($permission->delete()) {
            return redirect()->action('Backend\PermissionsController@index')->with('success', trans('messages.success.deleted'));

        }
        return redirect()->action('Backend\PermissionsController@index')->with('error', trans('messages.error.updated'));

    }

}