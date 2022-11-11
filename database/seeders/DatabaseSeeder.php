<?php

namespace Database\Seeders;

use App\Jobs\ProcessUserAgent;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Rating;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();
        $categories = Category::factory(25)->create();
        $tags = Tag::factory(100)->create();

        $posts = Post::factory(100)->make()->each(function ($post) use ($users, $categories, $tags) {
            $post->category_id = $categories->random()->id;
            $post->user_id = $users->random()->id;
            $post->save();
        });

        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach($tags->random(rand(5, 10))->pluck('id'));
            $post->save();
        });

        Rating::factory(40)->make()->each(function ($rating) use ($posts) {
            $rating->ratingable_id = $posts->random()->id;
            $rating->ratingable_type = Post::class;
            $rating->save();
        });

        for ($index = 0, $count = 60; $index < $count; $index++) {
            ProcessUserAgent::dispatch(fake()->ipv4, fake()->userAgent())->onQueue('parsing');
        }
    }
}
