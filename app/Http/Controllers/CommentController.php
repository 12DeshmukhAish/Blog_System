<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // Empty constructor as middleware is defined in the middleware method
    }

    public static function middleware()
    {
        return [
            'auth' => ['only' => ['store', 'update', 'destroy']]
        ];
    }

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|min:3|max:1000'
        ]);

        $comment = new Comment([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'post_id' => $post->id
        ]);

        $post->comments()->save($comment);

        return back()->with('success', 'Comment added successfully');
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        abort_if(!auth()->user()->can('update', $comment), 403);

        $validated = $request->validate([
            'content' => 'required|min:3|max:1000'
        ]);

        $comment->update($validated);

        return back()->with('success', 'Comment updated successfully');
    }

    public function destroy(Post $post, Comment $comment)
{
    // Add authorization check
    if (auth()->user()->isAdmin() || auth()->id() === $comment->user_id) {
        // Verify the comment belongs to the post
        if ($comment->post_id !== $post->id) {
            return redirect()->back()->with('error', 'Invalid comment.');
        }
        
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
    
    return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
}
}