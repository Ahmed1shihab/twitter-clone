<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeTweetController extends Controller
{
    public function like($tweetId)
    {
        Auth::user()->likes()->attach($tweetId, ['liked_at' => now()->format('Y-m-d H:i:s')]);

        return redirect()->back();
    }

    public function unlike($tweetId)
    {
        Auth::user()->likes()->detach($tweetId);

        return redirect()->back();
    }
}
