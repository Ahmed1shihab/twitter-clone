<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::factory()->count(5)
            ->for(Tweet::factory()->for(User::factory()))
            ->for(User::factory())
            ->create();
    }
}
