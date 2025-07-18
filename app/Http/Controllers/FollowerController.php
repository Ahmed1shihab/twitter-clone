<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function follow($userId)
    {
        $follower = Auth::user();

        $follower->followings()->attach($userId);

        return redirect()->back();
    }

    public function unfollow($userId)
    {
        $follower = Auth::user();

        $follower->followings()->detach($userId);

        return redirect()->back();
    }
}
