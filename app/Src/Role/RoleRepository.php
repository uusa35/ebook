<?php namespace App\Src\Role;

use App\Core\PrimaryRepository;



/**
 * App\Src\Role\RoleRepository
 *
 */
class RoleRepository extends PrimaryRepository
{

    public function __construct(Role $role)
    {
        return $this->model = $role;
    }

}