@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0">Edit Post</h5>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('posts.update', $post) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label for="title" class="form-label fw-bold mb-2">Title</label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('title') is-invalid @enderror"
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $post->title) }}" 
                                   required
                                   placeholder="Enter post title">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="content" class="form-label fw-bold mb-2">Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                      id="content" 
                                      name="content" 
                                      rows="8" 
                                      required
                                      placeholder="Write your post content here...">{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Update Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 8px;
    }
    
    .card-header {
        border-radius: 8px 8px 0 0;
    }
    
    .form-control {
        padding: 0.75rem 1rem;
        border-radius: 6px;
        border: 1px solid #dee2e6;
    }
    
    .form-control:focus {
        border-color: #4dabf7;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .btn {
        padding: 0.5rem 1.5rem;
        font-weight: 500;
    }
    
    textarea {
        min-height: 200px;
        resize: vertical;
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto-expand textarea as user types
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.querySelector('#content');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });
</script>
@endpush
@endsection