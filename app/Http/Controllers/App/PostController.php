<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $nbrPages;

    public function __construct()
    {
        $this->nbrPages = config('app.nbrPages.posts');
    }

    /**
     * Display list posts.
     *
     * @return \Illuminate\View\View
     */
    public function posts()
    {
        $posts = Post::where('account_id', Auth::user()->account_id)->paginate($this->nbrPages);
        return view('app.posts', compact('posts'));
    }

    public function categories()
    {
        $categories = Category::where('account_id', Auth::user()->account_id)->get();
        return view('app.categories', compact('categories'));
    }

    public function categories_store(Request $request)
    {
        $data = $request->all();
        $data['account_id'] = Auth::user()->account_id;
        Category::create($data);
        return redirect('app/blog/categories');
    }

    public function categories_edit($id)
    {
        $categories = Category::where('account_id', Auth::user()->account_id)->get();
        $current_category = Category::where('id', $id)->first();
        return view('app.categories', compact('categories', 'current_category'));
    }

    public function categories_update($id, Request $request)
    {
        $data = $request->all();
        $category = Category::where('id', $id)->first();
        $category->update($data);
        return redirect()->route('app.blog.categories.edit', ['id' => $category->id]);
    }

    /**
     * Create a post
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('app.post.create');
    }

    /**
     * Edit a post
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('app.post.edit', compact('post'));
    }

    /**
     * Store a post
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $data['meta_description'] = "test";
        $data['meta_keywords'] = "test";
        $data['account_id'] = Auth::user()->account_id;
        Post::create($data);
        $this->saveCategoriesAndTags($data, $request);
        return redirect('app/posts');
    }

    protected function saveCategoriesAndTags($post, $request)
    {
        // Categorie
        $post->categories()->sync($request->categories);
        // Tags
        $tags_id = [];
        if($request->tags) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $tag) {
                $tag_ref = Tag::firstOrCreate([
                    'tag' => ucfirst($tag),
                    'slug' => Str::slug($tag),
                ]);
                $tags_id[] = $tag_ref->id;
            }
        }
        $post->tags()->sync($tags_id);
    }
}
