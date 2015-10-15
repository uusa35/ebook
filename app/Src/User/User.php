<?php

namespace App\Src\User;

use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * App\Src\User\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('entrust.role')[] $roles
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, EntrustUserTrait, Messagable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    //public $localStrings = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'avatar', 'active'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function previews()
    {
        return $this->hasMany('App\Src\Book\Chapter\Preview');
    }
}
