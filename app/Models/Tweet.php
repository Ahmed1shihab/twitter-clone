<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


class Tweet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'content',
        'image',
        'like_count',
        'retweet_count',
        'save_count',
        'comment_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d M, Y \a\t H:s',
    ];

    /**
     * Get the user that owns the tweet.
     */
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    /**
     * Get the comments for the blog tweet.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the likes associated with the tweet.
     */
    public function likes(): BelongsToMany
    {
        return $this->BelongsToMany(User::class, 'like_tweet')->withPivot('liked_at');
    }

    public function liked($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Get the saves associated with the tweet.
     */
    public function saves(): BelongsToMany
    {
        return $this->BelongsToMany(User::class, 'save_tweet')->withPivot('saved_at');
    }

    public function savedTweet($userId)
    {
        return $this->saves()->where('user_id', $userId)->exists();
    }

    /**
     * Get the retweets associated with the tweet.
     */
    public function retweets(): BelongsToMany
    {
        return $this->BelongsToMany(User::class, 'retweet_tweet')->withPivot('retweeted_at');
    }

    public function retweeted($userId)
    {
        return $this->retweets()->where('user_id', $userId)->exists();
    }

    /**
     * Get the tweet image URL.
     */
    public function getImageAttribute()
    {
        if (!$this->attributes['image']) {
            return null;
        }
        return url('/storage/' . $this->attributes['image']);
    }

    /**
     * Get the tweet comment count.
     */
    protected function commentCount(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => shortNumber($value) . Str::plural(' Comment', $value),
        );
    }

    /**
     * Get the tweet save count.
     */
    protected function savesCount(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => shortNumber($value) . Str::plural(' Save', $value),
        );
    }

    /**
     * Get the tweet retweet count.
     */
    protected function retweetsCount(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => shortNumber($value) . Str::plural(' Retweet', $value),
        );
    }

    /**
     * Get the tweet like count.
     */
    protected function likesCount(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => shortNumber($value) . Str::plural(' like', $value),
        );
    }

    public function isRetweet(): bool
    {
        // This method might not be needed with pivot table approach
        // OR you can check if current user retweeted this tweet
        return $this->isRetweetedBy(auth()->id());
    }

    /**
     * Check if this tweet is retweeted by a specific user
     */
    public function isRetweetedBy(?int $userId): bool
    {
        if (!$userId) {
            return false;
        }

        return $this->retweets()->where('user_id', $userId)->exists();
    }

    /**
     * Check if this tweet is liked by a specific user
     */
    public function isLikedBy(?int $userId): bool
    {
        if (!$userId) {
            return false;
        }

        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Check if this tweet is saved by a specific user
     */
    public function isSavedBy(?int $userId): bool
    {
        if (!$userId) {
            return false;
        }

        return $this->saves()->where('user_id', $userId)->exists();
    }
}
