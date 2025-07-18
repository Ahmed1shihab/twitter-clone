<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'country',
        'gender',
        'bio',
        'profile_image',
    ];

    public $fullname = 'John Smith';

    /**
     * Get the user that owns the profile.
     */
    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    /**
     * Get the user's full name.
     */
    public function fullName()
    {
        // return $this->firstName . ' ' . $this->lastName;
        return 'ahome';
    }
}
