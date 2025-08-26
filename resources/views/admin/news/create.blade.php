@extends('admin.layouts.app')

@section('title', 'Add News')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Add News</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Excerpt</label>
                <textarea name="excerpt" class="form-control" rows="3" required>{{ old('excerpt') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button class="btn btn-success">Save</button>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
