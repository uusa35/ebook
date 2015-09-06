<?php namespace App\Src\Permission;

use App\Core\AbstractRepository;
use App\Src\Permission\Permission;



class PermissionRepository extends AbstractRepository
{

    public function __construct(Permission $permission)
    {
        return $this->model = $permission;
    }
}