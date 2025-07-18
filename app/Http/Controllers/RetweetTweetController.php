<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetweetTweetController extends Controller
{
    public function retweet($tweetId)
    {
        Auth::user()->retweets()->attach($tweetId, ['retweeted_at' => now()->format('Y-m-d H:i:s')]);

        return redirect()->back();
    }

    public function unretweet($tweetId)
    {
        Auth::user()->retweets()->detach($tweetId);

        return redirect()->back();
    }
}
