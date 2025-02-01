@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Welcome Card -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Welcome Back') }}, {{ Auth::user()->name }}!</span>
                    <span class="badge bg-primary">{{ Auth::user()->isAdmin() ? 'Admin' : 'User' }}</span>
                </div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="user-info p-3 bg-light rounded">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div class="ms-3">
                                <p class="mb-1"><strong>{{ __('Name') }}:</strong> {{ Auth::user()->name }}</p>
                                <p class="mb-0"><strong>{{ __('Email') }}:</strong> {{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Added All Blogs Button -->
                    <div class="text-center mt-4">
                        <a href="{{ route('posts.index') }}" class="btn btn-primary">
                            <i class="fas fa-book-open me-2"></i>View All Blogs
                        </a>
                    </div>
                </div>
            </div>

            <!-- Posts Section -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Posts</h5>
                    <div>
                        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-success me-2">
                            <i class="fas fa-plus me-1"></i>New Post
                        </a>
                        <a href="{{ route('posts.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-list me-1"></i>All Posts
                        </a>
                    </div>
                </div>
                <div class="card-body text-center py-5">
                    @if(isset($posts) && $posts->count() > 0)
                        <div class="activity-timeline">
                            @foreach($posts as $post)
                                <div class="post-item mb-3 pb-3 border-bottom">
                                    <h5>{{ $post->title }}</h5>
                                    <p class="text-muted mb-2">
                                        Posted on {{ $post->created_at->format('M d, Y') }}
                                    </p>
                                    <p class="mb-2">{{ Str::limit($post->content, 150) }}</p>
                                    <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary btn-sm">Read More</a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="start-journey">
                            <h3 class="mb-3">Start Your Journey</h3>
                            <p class="text-muted mb-4">Share your thoughts and ideas with the world by creating your first post.</p>
                            <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Your First Post</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add custom styles -->
@push('styles')
<style>
    .user-info {
        border-radius: 10px;
    }
    .card {
        transition: transform 0.2s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .badge {
        font-weight: 500;
    }
    .start-journey {
        max-width: 500px;
        margin: 0 auto;
    }
    .post-item:last-child {
        border-bottom: none !important;
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }
    .btn {
        border-radius: 6px;
    }
    .btn i {
        font-size: 0.9em;
    }
</style>
@endpush
@endsection