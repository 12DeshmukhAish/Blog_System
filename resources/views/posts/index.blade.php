@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                    <h4 class="mb-0 fw-bold text-primary">Posts</h4>
                    @auth
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle me-1"></i> Create Post
                        </a>
                    @endauth
                </div>

                <div class="card-body p-4">
                    @foreach ($posts as $post)
                        <div class="post-card mb-4 pb-4 border-bottom">
                            <h3 class="mb-2">
                                <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark fw-bold">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&size=32" 
                                     class="rounded-circle me-2" 
                                     alt="User avatar">
                                <span class="text-muted">
                                    By <span class="fw-medium">{{ $post->user->name }}</span> • 
                                    <span class="text-muted">{{ $post->created_at->format('M d, Y') }}</span>
                                </span>
                            </div>
                            <p class="text-muted mb-3">{{ Str::limit($post->content, 200) }}</p>
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary btn-sm">
                                Read More
                            </a>
                        </div>
                    @endforeach

                    <div class="mt-4">
                        {{ $posts->links() }}
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
    
    .post-card:last-child {
        border-bottom: none !important;
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }
    
    .pagination {
        justify-content: center;
    }
</style>
@endpush
@endsection