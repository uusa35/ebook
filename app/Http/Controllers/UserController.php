<?php

namespace App\Http\Controllers;

use App\Core\AbstractController;
use App\Src\Book\BookRepository;
use App\Src\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests;


class UserController extends AbstractController
{


    protected $userRepository;
    protected $bookRepository;

    public function __construct(UserRepository $userRepository, BookRepository $bookRepository)
    {

        $this->userRepository = $userRepository;

    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id);

        $userBooks = $user->books()->paginate(5);

        return view('frontend.modules.user.profile',compact('user','userBooks'));
    }


}
