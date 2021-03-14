<?php

namespace Database\Seeders;

use App\Models\{Post, Category, Tag};
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Account::factory(1)->create();
        \App\Models\User::factory(1)->create();
        DB::table('configs')->insert([
            [
                'logo' => '',
                'facebook_link' => '',
                'twitter_link' => '',
                'instagram_link' => '',
                'linkedin_link' => '',
                'account_id' => 1,
            ]
        ]);
        DB::table('categories')->insert([
            [
                'title' => 'Category 1',
                'slug' => 'category-1',
                'account_id' => 1
            ],
            [
                'title' => 'Category 2',
                'slug' => 'category-2',
                'account_id' => 1
            ],
            [
                'title' => 'Category 3',
                'slug' => 'category-3',
                'account_id' => 1
            ],
        ]);
        $nbrCategories = 3;
        DB::table('tags')->insert([
            ['tag' => 'Tag1', 'slug' => 'tag1', 'account_id' => 1],
            ['tag' => 'Tag2', 'slug' => 'tag2', 'account_id' => 1],
            ['tag' => 'Tag3', 'slug' => 'tag3', 'account_id' => 1],
            ['tag' => 'Tag4', 'slug' => 'tag4', 'account_id' => 1],
            ['tag' => 'Tag5', 'slug' => 'tag5', 'account_id' => 1],
            ['tag' => 'Tag6', 'slug' => 'tag6', 'account_id' => 1]
        ]);
        $nbrTags = 6;
        Post::withoutEvents(function () {
            foreach (range(1, 9) as $i) {
                Post::factory()->create([
                    'title' => 'Post ' . $i,
                    'slug' => 'post-' . $i,
                    'seo_title' => 'Post ' . $i,
                    'account_id' => 1,
                    'thumbnail' => 'img0' . $i . '.jpg',
                ]);
            }
        });
        $nbrPosts = 9;
        $posts = Post::all();
        foreach ($posts as $post) {
            if ($post->id === 9) {
                $numbers=[1,2,5,6];
                $n = 4;
            } else {
                $numbers = range (1, $nbrTags);
                shuffle ($numbers);
                $n = rand (2, 4);
            }
            for($i = 0; $i < $n; ++$i) {
                $post->tags()->attach($numbers[$i]);
            }
        }
// Set categories
        foreach ($posts as $post) {
            if ($post->id === 9) {
                DB::table ('category_post')->insert ([
                    'category_id' => 1,
                    'post_id' => 9,
                ]);
            } else {
                $numbers = range (1, $nbrCategories);
                shuffle ($numbers);
                $n = rand (1, 2);
                for ($i = 0; $i < $n; ++$i) {
                    DB::table ('category_post')->insert ([
                        'category_id' => $numbers[$i],
                        'post_id' => $post->id,
                    ]);
                }
            }
        }
    }
}
