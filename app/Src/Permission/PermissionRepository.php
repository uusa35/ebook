<?php namespace App\Src\Permission;

use App\Core\PrimaryRepository;
use App\Src\Permission\Permission;



/**
 * App\Src\Permission\PermissionRepository
 *
 */
class PermissionRepository extends PrimaryRepository
{

    public function __construct(Permission $permission)
    {
        return $this->model = $permission;
    }
}