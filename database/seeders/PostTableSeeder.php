<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\ImageFetcher;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(ImageFetcher $fetcher)
    {
        $posts = Post::factory()
        ->has(Comment::factory()->count(fake()->numberBetween(2,8)))
        ->count(fake()->numberBetween(22,24))->create()
        ->each(function ($post) {
            $tagIds = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id')->toArray();
            $post->tags()->attach($tagIds);
        });

        foreach ($posts as $post) {
            $imagePath = $fetcher->fetchRandomImage();
            $post->images()->create([
                'path' => $imagePath,
            ]);
        }
    }
}
