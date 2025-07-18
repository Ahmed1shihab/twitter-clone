<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validated = $request->validate([
            'tweetContent' => 'min:1|max:255',
            'whoCanReply' => 'required',
            'image' => 'image|nullable',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tweet', 'public');
            $validated['image'] = $imagePath;
        }

        Tweet::create([
            'user_id' => Auth::user()->id,
            'content' => $validated['tweetContent'],
            'image' => $validated['image']
        ]);

        return redirect()->back()->with('message', 'Successfully created');
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
        Tweet::destroy($id);

        return redirect()->back()->with('message', 'Successfully deleted');
    }

    /**
     * Comment on a tweet.
     */
    public function comment(Request $request, string $tweetId)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $tweet = Tweet::findOrFail($tweetId);

        $comment = $tweet->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->input('comment'),
            'reply_to_id' => null, // Assuming no reply to another comment
            'like_count' => 0,
        ]);

        return redirect()->back()->with('message', 'Comment added successfully');
    }
}
