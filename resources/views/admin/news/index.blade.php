@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-6">
            <h1 class="mb-0">Latest News</h1>
        </div>
        <div class="col-6 text-end">
            <!-- Tombol Tambah Artikel Baru -->
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Article
            </a>
        </div>
    </div>

    <div class="row">
        @forelse($news as $article)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" 
                             class="card-img-top" 
                             alt="{{ $article->title }}" 
                             style="height: 250px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ $article->excerpt }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                By {{ $article->author->name ?? 'Admin' }} 
                                | {{ $article->created_at->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 d-flex justify-content-between">
                        <a href="{{ route('news.show', $article->slug) }}" class="btn btn-outline-primary btn-sm">
                            Read More
                        </a>

                        @auth
                            @if(auth()->user()->role === 'admin')
                                <div class="d-flex">
                                    <form action="{{ route('admin.news.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No news articles available at the moment.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $news->links() }}
    </div>
</div>
@endsection
