<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = trim(fake()->sentence(rand(4, 8)), '.');
        return [
            'category_id' => Category::inRandomOrder()->first(),
            'user_id' => User::inRandomOrder()->first(),
            'title' => $title,
            'slug' => Str::of($title)->slug('-'),
            'thumbnail' => 'images/image' . rand(1, 5) . '.jpg', // added in DB seeder
            'excerpt' => '<p>' . implode('</p><p>', fake()->paragraphs(2)) . '</p>',
            'body' => '<p>' . implode('</p><p>', fake()->paragraphs(rand(5, 10))) . '</p>',
            'published_at' => fake()->dateTimeThisYear(),
        ];
    }
}
