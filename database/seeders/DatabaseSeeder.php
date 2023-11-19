<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private static $userCount = 3;
    private static $categoryCount = 5;
    private static $postCountPerUserPerCategory = 5;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Post::truncate();
        Category::truncate();
        User::truncate();

        $users = User::factory(static::$userCount)->create();
        $categories = Category::factory(static::$categoryCount)->create();

        $users->each(function ($user) use ($categories) {
            $categories->each(function ($category) use ($user) {
                Post::factory(static::$postCountPerUserPerCategory)->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                ]);
            });
        });        
    }
}
