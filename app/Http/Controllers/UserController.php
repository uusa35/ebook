<?php

namespace App\Http\Controllers;

use App\Core\AbstractController;
use App\Src\User\Blocked\Blocked;
use App\Src\User\Follower\Follower;
use App\Src\User\UserRepository;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends AbstractController
{


    protected $userRepository;
    protected $follower;
    protected $blocked;

    public function __construct(UserRepository $userRepository, Follower $follower, Blocked $blocked)
    {

        $this->userRepository = $userRepository;
        $this->follower = $follower;
        $this->blocked = $blocked;

    }

    public function show($id)
    {
        $user = $this->userRepository->model->where(['id' => $id])->with('followers', 'following', 'blocked')->first();


        // all users that are followed by the profile owner
        $userFollowersList = $user->followers->Lists('follower_id', 'follower_id')->toArray();

        // all users that following the profile owner

        $userFollowingList = $user->following->Lists('user_id', 'user_id')->toArray();

        // blocked list of the profile owner // WRONG
        //$userBlockedList = $user->blocked->Lists('blocked_id', 'blocked_id')->toArray();

        // blocked list of the authenticated user

        $userAuthenticatedBlockedList = $this->userRepository->getById(Auth::id())->blocked->Lists('blocked_id', 'blocked_id');

        if ($userAuthenticatedBlockedList) {

            $userAuthenticatedBlockedList = $userAuthenticatedBlockedList->toArray();

        }


        $followers = $this->follower->where('user_id', '=', $user->id)->with('user')->get();

        $userBooks = $user->books()
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))->from('chapters')->whereRaw('chapters.book_id = books.id')->where('chapters.status',
                    '=', 'published');
            })
            ->paginate(5);

        //dd($followers);

        //dd($user);

        return view('frontend.modules.user.profile',
            compact('user', 'userBooks', 'followers', 'userFollowersList', 'userBlockedList', 'userFollowingList', 'userAuthenticatedBlockedList'));
    }

    public function getUserRole()
    {

        return $this->userRepository->getUserRole();

    }

    /*
     * Me the Auth::id() (follower_id) will follow the user_id
     * */
    public function followUser($userId, $followerId)
    {

        $query = DB::table('user_followers')->where([
            'user_id' => $userId,
            'follower_id' => $followerId
        ])->get();

        if (!$query) {

            DB::table('user_followers')->insert([
                'user_id' => $userId,
                'follower_id' => $followerId
            ]);

            return redirect()->back()->with(['success' => 'messages.success.follow_success']);

        }

        return redirect()->back()->with(['error' => 'messages.error.follow_error']);
    }


    /*
    * delete all followers_id where user_id = Auth::id
    */
    public function unFollowUser($userId, $followerId)
    {

        $query = DB::table('user_followers')->where([
            'user_id' => $userId,
            'follower_id' => $followerId
        ])->delete();

        if ($query) {

            return redirect()->back()->with(['success' => 'messages.success.follow_success']);

        }

        return redirect()->back()->with(['error' => 'messages.error.follow_error']);


    }

    public function blockUser($blockedId)
    {
        $query = DB::table('user_blocks')->where([
            'user_id' => Auth::id(),
            'blocked_id' => $blockedId
        ])->get();

        if (!$query) {

            DB::table('user_blocks')->insert([
                'user_id' => Auth::id(),
                'blocked_id' => $blockedId
            ]);

            return redirect()->back()->with(['success' => 'messages.success.block_success']);

        }

        return redirect()->back()->with(['error' => 'messages.error.block_error']);

    }

    public function unBlockUser($blockedId)
    {

        $query = DB::table('user_blocks')->where([
            'user_id' => Auth::id(),
            'blocked_id' => $blockedId
        ])->delete();

        if ($query) {

            return redirect()->back()->with(['success' => 'messages.success.block_success']);

        }

        return redirect()->back()->with(['error' => 'messages.error.block_error']);

    }

}
