<?php

namespace App\Src\Role;

use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

class Role extends EntrustRole
{
    //
    use EntrustRoleTrait;

    protected $fillable = ['name','display_name', 'description'];
}
