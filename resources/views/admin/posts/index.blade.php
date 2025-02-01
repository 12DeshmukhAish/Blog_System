@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Manage Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle mr-1"></i> Create New Post
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="{{ route('admin.posts.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" 
                               placeholder="Search posts..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                </div>
                            </th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="selected[]" value="{{ $post->id }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ $post->title }}</span>
                                        <small class="text-muted">{{ Str::limit($post->excerpt, 60) }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $post->user->avatar_url ?? asset('images/default-avatar.png') }}" 
                                             class="rounded-circle mr-2" width="32" height="32" alt="{{ $post->user->name }}">
                                        <span>{{ $post->user->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $post->status == 'published' ? 'success' : 'warning' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                                        <small class="text-muted">{{ $post->created_at->format('H:i A') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.posts.edit', $post) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.posts.show', $post) }}" 
                                           class="btn btn-sm btn-outline-info" 
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this post?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                        <h5>No Posts Found</h5>
                                        <p class="text-muted">Start by creating your first post</p>
                                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary mt-2">
                                            Create New Post
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Bulk Actions and Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="bulk-actions">
                    <select class="form-select form-select-sm" style="width: 200px;">
                        <option value="">Bulk Actions</option>
                        <option value="publish">Publish Selected</option>
                        <option value="draft">Move to Draft</option>
                        <option value="delete">Delete Selected</option>
                    </select>
                    <button class="btn btn-sm btn-secondary ms-2">Apply</button>
                </div>
                <div class="pagination-wrapper">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }

    .pagination-wrapper .pagination {
        margin-bottom: 0;
    }

    .badge {
        padding: 0.5em 0.8em;
    }

    .form-check-input {
        cursor: pointer;
    }

    .bulk-actions {
        display: flex;
        align-items: center;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select All Functionality
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('input[name="selected[]"]');

    selectAll.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            const someChecked = Array.from(checkboxes).some(cb => cb.checked);
            
            selectAll.checked = allChecked;
            selectAll.indeterminate = someChecked && !allChecked;
        });
    });

    // Bulk Actions
    const bulkActionSelect = document.querySelector('.bulk-actions select');
    const bulkActionButton = document.querySelector('.bulk-actions button');

    bulkActionButton.addEventListener('click', function() {
        const selectedAction = bulkActionSelect.value;
        const selectedPosts = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        if (!selectedAction) {
            alert('Please select an action');
            return;
        }

        if (selectedPosts.length === 0) {
            alert('Please select at least one post');
            return;
        }

        if (confirm('Are you sure you want to perform this action on the selected posts?')) {
            // Here you would typically make an AJAX request to a bulk action endpoint
            console.log('Action:', selectedAction, 'Posts:', selectedPosts);
        }
    });
});
</script>
@endpush