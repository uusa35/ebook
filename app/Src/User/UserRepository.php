<?php namespace App\Src\User;

use App\Core\AbstractRepository;
use App\Src\User\User;


class UserRepository extends AbstractRepository
{


    public function __construct(User $user)
    {
        return $this->model = $user;
    }

}