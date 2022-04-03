<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(User $user)
    {
        $this->authorize('follow', $user);

        if ( ! Auth::user()->isFollowing($user->id)) {
            Auth::user()->follow($user->id);
        }

        session()->flash('success', '已关注！');
        return redirect()->route('users.show', $user->id);

        //return redirect()->back();
    }

    public function destroy(User $user)
    {
        $this->authorize('follow', $user);

        if ( Auth::user()->isFollowing($user->id)) {
            Auth::user()->unfollow($user->id);
        }
        session()->flash('success', '取消关注！');
        return redirect()->route('users.show', $user->id);
        //return redirect()->back();
    }
}
