<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AppPostController extends Controller
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
        $data['slug'] = Str::slug($data['name']);
        $data['meta_description'] = "test";
        $data['meta_keywords'] = "test";
        $data['account_id'] = Auth::user()->account_id;
        Post::create($data);
        return redirect('app/posts');
    }
}
