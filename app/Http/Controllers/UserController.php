<?php

namespace App\Http\Controllers;

use App\Core\AbstractController;
use App\Src\User\UserRepository;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;


class UserController extends AbstractController
{


    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;

    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id);

        $userBooks = $user->books()
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))->from('chapters')->whereRaw('chapters.book_id = books.id')->where('chapters.status',
                    '=', 'published');
            })
            ->paginate(5);

        return view('frontend.modules.user.profile', compact('user', 'userBooks'));
    }

    public function getUserRole() {

        return $this->userRepository->getUserRole();

    }

}
