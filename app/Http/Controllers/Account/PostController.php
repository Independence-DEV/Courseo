<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\IndexPage;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $nbrPages;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->nbrPages = config('app.nbrPages.posts');
    }

    /**
     * Display index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $heros = $this->postRepository->getHeros();
        $indexPage = IndexPage::where('account_id', config('account.account_id'))->first();
        return view('account.index', compact( 'heros', 'indexPage'));
    }

    /**
     * Display list posts.
     *
     * @return \Illuminate\View\View
     */
    public function posts()
    {
        $posts = $this->postRepository->getActiveOrderByDate($this->nbrPages);
        return view('account.posts', compact('posts'));
    }

    /**
     * Display list posts.
     *
     * @return \Illuminate\View\View
     */
    public function post($domain, $slug)
    {
        $post = $this->postRepository->getPostBySlug($slug);
        return view('account.post', compact('post'));
    }
}
