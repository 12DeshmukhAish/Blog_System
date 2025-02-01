@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-0 fw-bold text-primary">{{ $post->title }}</h1>
                        @can('update', $post)
                            <div class="d-flex gap-2">
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this post?')">
                                        <i class="fas fa-trash-alt me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        @endcan
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&size=32" 
                             class="rounded-circle me-2" 
                             alt="User avatar">
                        <span class="text-muted">
                            By <span class="fw-medium">{{ $post->user->name }}</span> • 
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                        </span>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="post-content mb-5">
                        {{ $post->content }}
                    </div>

                    <!-- Comments Section -->
                    <div class="comments-section mt-5">
                        <h4 class="fw-bold mb-4">Comments</h4>

                        @auth
                            <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-4">
                                @csrf
                                <div class="form-group">
                                    <textarea name="content" 
                                              class="form-control" 
                                              rows="3" 
                                              placeholder="Write your comment here..."
                                              required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="fas fa-paper-plane me-1"></i> Add Comment
                                </button>
                            </form>
                        @else
                            <div class="alert alert-info">
                                Please <a href="{{ route('login') }}" class="fw-bold">login</a> to comment.
                            </div>
                        @endauth

                        <div class="comments">
                            @foreach($post->comments()->with('user')->latest()->get() as $comment)
                                <div class="comment bg-light p-3 rounded mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&size=32" 
                                                 class="rounded-circle me-2" 
                                                 alt="User avatar">
                                            <div>
                                                <strong class="d-block">{{ $comment->user->name }}</strong>
                                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        @if(auth()->user()->isAdmin() || auth()->id() === $comment->user_id)
    <form action="{{ route('comments.destroy', ['post' => $post->id, 'comment' => $comment->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="btn btn-outline-danger btn-sm"
                onclick="return confirm('Delete this comment?')">
            <i class="fas fa-trash-alt"></i>Delete
        </button>
    </form>
@endif

                                    </div>
                                    <p class="mb-0">{{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 10px;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
    
    .post-content {
        font-size: 1.1rem;
        line-height: 1.7;
    }
    
    .comment {
        transition: background-color 0.2s ease;
    }
    
    .comment:hover {
        background-color: #f8f9fa !important;
    }
    
    .form-control {
        border-radius: 6px;
        border: 1px solid #dee2e6;
    }
    
    .form-control:focus {
        border-color: #4dabf7;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .btn {
        border-radius: 6px;
    }
</style>
@endpush
@endsection