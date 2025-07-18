<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveTweetController extends Controller
{
    public function save($tweetId)
    {
        Auth::user()->saves()->attach($tweetId, ['saved_at' => now()->format('Y-m-d H:i:s')]);

        return redirect()->back();
    }

    public function unsave($tweetId)
    {
        Auth::user()->saves()->detach($tweetId);

        return redirect()->back();
    }
}
