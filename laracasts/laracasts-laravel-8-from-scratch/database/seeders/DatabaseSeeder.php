<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Sergio Fernandez'
        ]);

        Post::factory(5)->create([
            'user_id' => $user->id
        ]);

        Post::factory(5)->create();

        Comment::factory(5)->create();
    }
}
