<?php namespace App\Src\Permission;

use App\Core\AbstractRepository;
use App\Src\Permission\Permission;



/**
 * App\Src\Permission\PermissionRepository
 *
 */
class PermissionRepository extends AbstractRepository
{

    public function __construct(Permission $permission)
    {
        return $this->model = $permission;
    }
}