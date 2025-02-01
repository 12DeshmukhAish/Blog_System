<?php
namespace App\Http\Controllers;

use App\Services\CacheService;
use App\Models\Post;
use Illuminate\Http\Request;

class OptimizedPostController extends Controller
{
    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $posts = $this->cacheService->getCachedPosts($page);
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->cacheService->getCachedPost($id);
        return view('posts.show', compact('post'));
    }
}