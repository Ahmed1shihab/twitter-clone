<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tweet_id',
        'reply_to_id',
        'content',
        'like_count',
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
     * Get the comment like count.
     */
    protected function likeCount(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => shortNumber($value) . Str::plural(' like', $value),
        );
    }

    /**
     * Get the tweet that owns the comment.
     */
    public function tweet(): BelongsTo
    {
        return $this->belongsTo(Tweet::class);
    }

    /**
     * Get the user that owns the comment.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
