<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $username)
    {
        $user = User::with(['tweets' => function ($query) {
            $query->orderBy('created_at', 'desc')->with('user');
        }])
            ->where('username', $username)
            ->withCount(['followers', 'followings'])
            ->firstOrFail();

        if (Auth::check()) {
            $follows = Auth::user()->follows($user->id);
        } else {
            $follows = false;
        }

        $tab = $request->query('tab', 'tweets');
        $currentUserId = Auth::id();

        if ($tab === 'retweets') {
            // Get tweets that this user has retweeted
            $retweetedTweets = $user->retweets()
                ->with('user')
                ->get()
                ->sortByDesc('created_at');

            $retweetedTweets = $retweetedTweets->map(function ($tweet) use ($currentUserId) {
                $tweet->retweeted = $tweet->isRetweetedBy($currentUserId);
                $tweet->saved = $tweet->isSavedBy($currentUserId);
                $tweet->liked = $tweet->isLikedBy($currentUserId);
                return $tweet;
            });

            // Unset the original relationship and set the new data
            $user->unsetRelation('tweets');
            $user->setRelation('tweets', $retweetedTweets);
        } elseif ($tab === 'likes') {
            // Get tweets that this user has liked
            $likedTweets = $user->likes()
                ->with('user')
                ->get()
                ->sortByDesc('created_at');

            $likedTweets = $likedTweets->map(function ($tweet) use ($currentUserId) {
                $tweet->retweeted = $tweet->isRetweetedBy($currentUserId);
                $tweet->saved = $tweet->isSavedBy($currentUserId);
                $tweet->liked = $tweet->isLikedBy($currentUserId);
                return $tweet;
            });

            $user->unsetRelation('tweets');
            $user->setRelation('tweets', $likedTweets);
        } elseif ($tab === 'saves') {
            // Get tweets that this user has saved
            $savedTweets = $user->saves()
                ->with('user')
                ->get()
                ->sortByDesc('created_at');

            $savedTweets = $savedTweets->map(function ($tweet) use ($currentUserId) {
                $tweet->retweeted = $tweet->isRetweetedBy($currentUserId);
                $tweet->saved = $tweet->isSavedBy($currentUserId);
                $tweet->liked = $tweet->isLikedBy($currentUserId);
                return $tweet;
            });

            $user->unsetRelation('tweets');
            $user->setRelation('tweets', $savedTweets);
        }

        return Inertia::render('Profile', [
            'user' => $user,
            'follows' => $follows
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
