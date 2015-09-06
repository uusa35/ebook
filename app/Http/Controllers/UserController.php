<?php

namespace App\Http\Controllers;

use App\Core\AbstractController;
use App\Src\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests;


class UserController extends AbstractController
{


    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;

    }


}
