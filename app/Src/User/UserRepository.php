<?php namespace App\Src\User;

use App\Core\AbstractRepository;


/**
 * App\Src\User\UserRepository
 *
 */
class UserRepository extends AbstractRepository
{


    public function __construct(User $user)
    {
        return $this->model = $user;

    }


    public function allUsersWithoutAdminsAndEditors($authId)
    {
        // todo: change ID for admin to get dynamic
        return $this->model
            ->selectRaw('users.*')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('users.id', '!=', $authId)
            ->where('role_user.role_id', '!=', 1)
            ->where('role_user.role_id', '!=', 2)
            ->get();
    }

    public function allAdminsAndEditors() {

        return $this->model
            ->selectRaw('users.*')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where(['role_user.role_id' =>  1])
            ->orWhere(['role_user.role_id' => 2])
            ->get();
    }

}