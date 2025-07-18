<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeTweetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetweetTweetController;
use App\Http\Controllers\SaveTweetController;
use App\Http\Controllers\TweetController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
Route::get('/profile/@{username}', [ProfileController::class, 'index'])->name('profile.index');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/follow/{user:id}', [FollowerController::class, 'follow'])->name('user.follow');
    Route::post('/unfollow/{user:id}', [FollowerController::class, 'unfollow'])->name('user.unfollow');

    Route::post('/like/{tweet:id}', [LikeTweetController::class, 'like'])->name('tweet.like');
    Route::post('/unlike/{tweet:id}', [LikeTweetController::class, 'unlike'])->name('tweet.unlike');

    Route::post('/save/{tweet:id}', [SaveTweetController::class, 'save'])->name('tweet.save');
    Route::post('/unsave/{tweet:id}', [SaveTweetController::class, 'unsave'])->name('tweet.unsave');

    Route::post('/retweet/{tweet:id}', [RetweetTweetController::class, 'retweet'])->name('tweet.retweet');
    Route::post('/unretweet/{tweet:id}', [RetweetTweetController::class, 'unretweet'])->name('tweet.unretweet');

    Route::post('/comment/{tweet:id}', [TweetController::class, 'comment'])->name('tweet.comment');


    Route::post('/tweet', [TweetController::class, 'store'])->name('tweet.store');
    Route::delete('/tweet/{id}', [TweetController::class, 'destroy'])->name('tweet.destroy');
});

require __DIR__ . '/auth.php';
