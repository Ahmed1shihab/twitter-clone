<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tweets = Tweet::query()
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'username', 'name', 'image');
                },
                'comments' => function ($query) {
                    $query->orderBy('like_count', 'desc')->with(['author' => function ($query) {
                        $query->select('id', 'username', 'name', 'image');
                    }]);
                }
            ])
            ->withCount(['likes', 'saves', 'retweets'])
            ->get();

        $tweets = $tweets->map(function ($tweet) {
            if (Auth::check()) {
                $t1 = collect($tweet)->put('liked', $tweet->liked(auth()->user()->id));
                $t2 = collect($tweet)->put('saved', $tweet->savedTweet(auth()->user()->id));
                $t3 = collect($tweet)->put('retweeted', $tweet->retweeted(auth()->user()->id));
            } else {
                $t1 = collect($tweet)->put('liked', false);
                $t2 = collect($tweet)->put('saved', false);
                $t3 = collect($tweet)->put('retweeted', false);
            }

            return $t1->merge($t2)->merge($t3);
        });

        // dd($tweets);

        return Inertia::render('Home/Home', [
            'tweets' => $tweets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
