<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'dob',
        'country',
        'gender',
        'bio',
        'image',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id');
    }

    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id');
    }

    public function follows($userId)
    {
        return $this->followings()->where('user_id', $userId)->exists();
    }

    /**
     * Get the saves associated with the user.
     */
    public function saves(): BelongsToMany
    {
        return $this->BelongsToMany(Tweet::class, 'save_tweet')->withPivot('saved_at');
    }

    /**
     * Get the retweets associated with the tweet.
     */
    public function retweets(): BelongsToMany
    {
        return $this->belongsToMany(Tweet::class, 'retweet_tweet', 'user_id', 'tweet_id')->withPivot('retweeted_at');
    }

    /**
     * Get the Tweets associated with the user.
     */
    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class);
    }

    /**
     * Get the comments associated with the user.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the likes associated with the user.
     */
    public function likes(): BelongsToMany
    {
        return $this->BelongsToMany(Tweet::class, 'like_tweet')->withPivot('liked_at');
    }

    /**
     * Get the followers  count.
     */
    protected function followersCount(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => '<span>' . shortNumber($value) . '</span>' . Str::plural(' follower', $value),
        );
    }

    /**
     * Get the followings  count.
     */
    protected function followingsCount(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => '<span>' . shortNumber($value) . '</span>' . Str::plural(' following', $value),
        );
    }

    /**
     * Tweets that this user has retweeted
     */
    public function retweetedTweets(): BelongsToMany
    {
        return $this->belongsToMany(Tweet::class, 'retweet_tweet', 'user_id', 'tweet_id')
            ->withPivot('retweeted_at');
        // ->withTimestamps();
    }

    /**
     * Check if user has retweeted a specific tweet
     */
    public function hasRetweeted(int $tweetId): bool
    {
        return $this->retweetedTweets()->where('tweet_id', $tweetId)->exists();
    }
}
