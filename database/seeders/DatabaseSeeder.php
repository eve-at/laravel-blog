<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class DatabaseSeeder extends Seeder
{

    private static $userCount = 20;
    private static $categoryCount = 5;
    private static $postCountPerUserPerCategory = 5;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Comment::truncate();
        Post::truncate();
        Category::truncate();
        User::truncate();

        $file = new Filesystem;
        $file->cleanDirectory('storage/app/public/images');
        for($i = 1; $i < 6; $i++) {
            $file->copy("public/images/image{$i}.jpg", "storage/app/public/images/image{$i}.jpg");
        }

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

        Post::all()->each(function ($post) {
            Comment::factory(rand(0, 5))->create([
                'post_id' => $post->id,
            ]);
        });
    }
}
