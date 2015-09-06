<?php namespace App\Src\Role;

use App\Core\AbstractRepository;



class RoleRepository extends AbstractRepository
{

    public function __construct(Role $role)
    {
        return $this->model = $role;
    }

}