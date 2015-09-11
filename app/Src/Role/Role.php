<?php

namespace App\Src\Role;

use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

/**
 * App\Src\Role\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('auth.model')[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('entrust.permission')[] $perms
 */
class Role extends EntrustRole
{
    //
    use EntrustRoleTrait;

    protected $fillable = ['name','display_name', 'description'];
}
