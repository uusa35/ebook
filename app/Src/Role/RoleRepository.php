<?php namespace App\Src\Role;

use App\Core\AbstractRepository;



/**
 * App\Src\Role\RoleRepository
 *
 */
class RoleRepository extends AbstractRepository
{

    public function __construct(Role $role)
    {
        return $this->model = $role;
    }

}