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
                'email_from' => 'test@test.test',
                'lang' => 'fr',
                'facebook_link' => '',
                'twitter_link' => '',
                'instagram_link' => '',
                'linkedin_link' => '',
                'account_id' => 1,
            ]
        ]);
        DB::table('config_payments')->insert([
            [
                'stripe_publishable_key' => '',
                'stripe_secret_key' => '',
                'account_id' => 1,
            ]
        ]);
        DB::table('customers')->insert([
            [
                'name' => 'test',
                'email' => 'test@test.test',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'account_id' => 1,
            ]
        ]);
        DB::table('index_pages')->insert([
            [
                'content' => '',
                'active_posts' => 1,
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
        DB::table('courses')->insert([
            [
                'title' => 'test',
                'slug' => 'test',
                'description' => 'test',
                'presentation' => 'test',
                'price' => 0,
                'active' => 0,
                'account_id' => 1
            ],
        ]);
        DB::table('chapters')->insert([
            [
                'title' => 'Chapter 1',
                'slug' => 'chapter-1',
                'order' => 1,
                'course_id' => 1
            ],
            [
                'title' => 'Chapter 2',
                'slug' => 'chapter-2',
                'order' => 2,
                'course_id' => 1
            ],
            [
                'title' => 'Chapter 3',
                'slug' => 'chapter-3',
                'order' => 3,
                'course_id' => 1
            ],
        ]);
        DB::table('lessons')->insert([
            [
                'title' => 'Lesson 1',
                'slug' => 'lesson-1',
                'content' => 'La lesson 1 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!',
                'video' => '',
                'order' => 1,
                'chapter_id' => 1
            ],
            [
                'title' => 'Lesson 2',
                'slug' => 'lesson-2',
                'content' => 'La lesson 2 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!',
                'video' => '',
                'order' => 2,
                'chapter_id' => 1
            ],
            [
                'title' => 'Lesson 3',
                'slug' => 'lesson-3',
                'content' => 'La lesson 3 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!',
                'video' => '',
                'order' => 3,
                'chapter_id' => 1
            ],
            [
                'title' => 'Lesson 1',
                'slug' => 'lesson-1',
                'content' => 'La lesson 1 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!',
                'video' => '',
                'order' => 1,
                'chapter_id' => 2
            ],
            [
                'title' => 'Lesson 2',
                'slug' => 'lesson-2',
                'content' => 'La lesson 2 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!',
                'video' => '',
                'order' => 2,
                'chapter_id' => 2
            ],
            [
                'title' => 'Lesson 1',
                'slug' => 'lesson-1',
                'content' => 'La lesson 1 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!',
                'video' => '',
                'order' => 1,
                'chapter_id' => 3
            ],
            [
                'title' => 'Lesson 2',
                'slug' => 'lesson-2',
                'content' => 'La lesson 2 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!',
                'video' => '',
                'order' => 2,
                'chapter_id' => 3
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
