<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PostController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // Empty constructor as middleware is defined in the middleware method
    }

    public static function middleware()
    {
        return [
            'auth' => ['except' => ['index', 'show']]
        ];
    }

    public function index()
    {
        $posts = Post::with(['user', 'comments.user'])
            ->latest()
            ->paginate(10);
            
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['author_id'] = auth()->id(); // Changed from user_id to author_id

        $post = Post::create($validatedData);
            
        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Post created successfully');
    }

    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']);
            
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        abort_if(!auth()->user()->can('update', $post), 403);
            
        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        abort_if(!auth()->user()->can('update', $post), 403);
            
        $post->update($request->validated());
            
        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        abort_if(!auth()->user()->can('delete', $post), 403);
            
        $post->delete();
            
        return redirect()
            ->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
}