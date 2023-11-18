<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
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
        $userCount = 3;
        $categoryCount = 5;
        $postCount = 15;
     
        Post::truncate();
        Category::truncate();
        User::truncate();

        User::factory($userCount)->create();
        Category::factory($categoryCount)->create();
        Post::factory($postCount)->create();
    }
}
