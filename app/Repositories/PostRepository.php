<?php

namespace App\Repositories;

use App\Models\{Post, Category, Tag};
use Illuminate\Support\Str;

class PostRepository
{
    protected function queryActive()
    {
        return Post::select(
            'id',
            'slug',
            'title',
            'thumbnail',
            'description')
            ->whereActive(true)
            ->where('account_id', config('account.account_id'));
    }
    protected function queryActiveOrderByDate()
    {
        return $this->queryActive()->latest();
    }
    public function getActiveOrderByDate($nbrPages)
    {
        return $this->queryActiveOrderByDate()->paginate($nbrPages);
    }
    public function getHeros()
    {
        return $this->queryActive()->with('categories')->latest('updated_at')->take(5)->get();
    }
    protected function saveCategories($post, $request)
    {
        // Categorie
        $post->categories()->sync($request->categories);
    }
    public function store($request)
    {
        $request->merge([
            'active' => $request->has('active'),
            'thumbnail' => basename($request->thumbnail),
        ]);
        $post = $request->user()->posts()->create($request->all());
        $this->saveCategoriesAndTags($post, $request);
    }
    public function getPostBySlug($slug)
    {
        // Post for slug with tags and categories
        $post = Post::with(
            'tags:id,tag,slug',
            'categories:title,slug'
        )
            ->whereSlug($slug)
            ->where('account_id', config('account.account_id'))
            ->firstOrFail();
        // Previous post
        $post->previous = $this->getPreviousPost($post->id);
        // Next post
        $post->next = $this->getNextPost($post->id);
        return $post;
    }
    protected function getPreviousPost($id)
    {
        return Post::select('title', 'slug')->latest('id')->firstWhere('id', '<', $id);
    }
    protected function getNextPost($id)
    {
        return Post::select('title', 'slug')->oldest('id')->firstWhere('id', '>', $id);
    }
}
