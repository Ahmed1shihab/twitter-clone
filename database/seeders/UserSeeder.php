<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => '7nv__',
            'name' => 'Ahmed shihab',
            'email' => 'ahmed@gmail.com',
            'image' => 'https://placehold.co/600/000000/FFF?text=A7med',
            'bio' => 'Dolore alias sed ullam aliquid. Ut dignissimos totam facere. Et ad dolore quibusdam et officia nemo iure. Amet et sit nisi saepe. Dolores reiciendis numquam sed ipsum.',
            'password' => Hash::make('password')
        ]);

        User::factory()->count(10)
            ->has(Tweet::factory()->has(Comment::factory(2)->for(User::factory(), 'author'))->for(User::factory()))
            ->create();
    }
}
