@extends('admin.layouts.app')

@section('title', 'Edit News')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit News</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" 
                       value="{{ old('title', $news->title) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Excerpt</label>
                <textarea name="excerpt" class="form-control" rows="3" required>{{ old('excerpt', $news->excerpt) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="5" required>{{ old('content', $news->content) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label><br>
                @if($news->image)
                    <img src="{{ asset('storage/' . $news->image) }}" alt="News Image" 
                         class="mb-2" style="max-height: 150px;">
                @endif
                <input type="file" name="image" class="form-control">
                <small class="text-muted">Upload to replace current image (optional)</small>
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
