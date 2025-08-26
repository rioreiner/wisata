@extends('admin.layouts.app')

@section('title', 'Manage News')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">News Articles</h3>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Add News</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Author</th>
                    <th>Created</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $article)
                <tr>
                    <td>
                        @if($article->image)
                            <img src="{{ asset('storage/'.$article->image) }}" width="80" class="rounded">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $article->title }}</td>
                    <td>{{ Str::limit($article->excerpt, 50) }}</td>
                    <td>{{ $article->author->name ?? 'Admin' }}</td>
                    <td>{{ $article->created_at->format('M d, Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.news.edit', $article->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.news.destroy', $article->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this news?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No news found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
