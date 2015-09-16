<?php namespace App\Http\Controllers\Backend;

use App\Core\AbstractController;
use App\Http\Controllers\Controller;
use App\Src\Permission\PermissionRepository;
use App\Src\Role\RoleRepository;
use Illuminate\Http\Request;

class PermissionsController extends AbstractController
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
        $this->getPageTitle(\Config::get('title.permissions.index'));

        $permissions = $this->permissionRepository->model->all();

        return view('backend.modules.permissions.index', compact('permissions'));
    }

    public function create()
    {

        $this->getPageTitle(\Config::get('title.permissions.create'));

        return view('backend.modules.permissions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|unique:permissions,name',
            'display_name' => 'required|unique:permissions,display_name',
            'level' => 'required'
        ));

        $permission = $this->permissionRepository->model->create($request->all());

        $role = $this->roleRepository->model->where('name','=', 'Admin')->first();

        $role->perms()->sync([$permission->id], false);

        return redirect()->action('Backend\PermissionsController@index')->with(['success' => 'messages.success.permission_edit']);
    }

    public function edit($id)
    {
        $this->getPageTitle(\Config::get('title.permissions.edit'));

        $permission = $this->permissionRepository->model->find($id);

        return view('backend.modules.permissions.edit', compact('permission'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, array('name' => 'required', 'display_name' => 'required'));

        $permission = $this->permissionRepository->model->find($id);
        $permission->update($request->all());

        return redirect()->action('Backend\PermissionsController@index')->with(['success' => 'messages.success.permission_update']);
    }

    public function destroy($id)
    {
        $permission = $this->permissionRepository->model->find($id)->first();

        $permission->delete();

        return redirect()->action('Backend\PermissionsController@index')->with(['success' => 'messages.success.permission_delete']);
    }

}