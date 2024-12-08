<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Alice',
            'email' => 'alice@mail.com',
        ]);

        User::factory()->create([
            'name' => 'Bob',
            'email' => 'bob@mail.com',
        ]);

        Article::factory(20)->create();
        Category::factory(5)->create();
        Comment::factory(40)->create();
        Tag::factory(10)->create();
        ArticleTag::factory(50)->create();
    }
}
