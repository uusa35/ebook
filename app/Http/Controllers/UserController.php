<?php

namespace App\Http\Controllers;

use App\Core\AbstractController;
use App\Src\User\Follower\Follower;
use App\Src\User\UserRepository;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;


class UserController extends AbstractController
{


    protected $userRepository;
    protected $follower;

    public function __construct(UserRepository $userRepository, Follower $follower)
    {

        $this->userRepository = $userRepository;
        $this->follower = $follower;

    }

    public function show($id)
    {
        $user = $this->userRepository->model->where(['id' => $id])->with('followers','following')->first();

        $userFollowersList = $user->followers->Lists('user_id','follower_id');

        //dd($userFollowersList);

        $followers = $this->follower->where('user_id','=', $user->id)->with('user')->get();


        $userBooks = $user->books()
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))->from('chapters')->whereRaw('chapters.book_id = books.id')->where('chapters.status',
                    '=', 'published');
            })
            ->paginate(5);

        return view('frontend.modules.user.profile', compact('user', 'userBooks','followers'));
    }

    public function getUserRole() {

        return $this->userRepository->getUserRole();

    }

    public function followUser($userId,$followerId) {

        $query = DB::table('user_followers')->insert([
            'user_id' => $userId,
            'follower_id' => $followerId
        ]);
        if ($query) {

            return redirect()->back()->with(['success' => 'messages.success.follow_success']);

        }

        return redirect()->back()->with(['error' => 'messages.error.follow_error']);
    }

}
