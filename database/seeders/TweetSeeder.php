<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tweet::factory()
            ->count(3)
            ->for(User::factory(1))
            ->has(Comment::factory(3))
            ->create();
    }
}
