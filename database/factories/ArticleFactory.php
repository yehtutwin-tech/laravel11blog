<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $image = $this->faker->image('public/storage/articles', 400, 400, 'articles');
        // $filename = str_replace('public/storage/articles', '', $image);
        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'category_id' => rand(1, 5),
            // 'image' => $filename,
        ];
    }
}
