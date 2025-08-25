{{-- resources/views/news/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-primary text-white text-center p-5 rounded">
                <h1 class="display-4 mb-3">Tourism News & Updates</h1>
                <p class="lead">Stay updated with the latest news and developments in the tourism industry</p>
            </div>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search news articles..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
                @if(request('search'))
                    <a href="{{ route('news.index') }}" class="btn btn-secondary ms-2">Clear</a>
                @endif
            </form>
        </div>
        <div class="col-md-4 text-end">
            <small class="text-muted">
                {{ $news->total() }} article(s) found
            </small>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            @if($news->count() > 0)
                <!-- Featured Article (First Article) -->
                @if($news->currentPage() == 1)
                    <div class="card mb-4 shadow-sm">
                        @php $featured = $news->first(); @endphp
                        @if($featured->image)
                            <img src="{{ asset('storage/' . $featured->image) }}" class="card-img-top" alt="{{ $featured->title }}" style="height: 300px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">Featured</span>
                            <h2 class="card-title">{{ $featured->title }}</h2>
                            <p class="card-text text-muted">{{ $featured->excerpt }}</p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user text-muted me-2"></i>
                                    <span class="text-muted">{{ $featured->author->name }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar text-muted me-2"></i>
                                    <span class="text-muted">{{ $featured->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <a href="{{ route('news.show', $featured->slug) }}" class="btn btn-primary">
                                Read Full Article <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Regular Articles Grid -->
                <div class="row">
                    @foreach($news->skip($news->currentPage() == 1 ? 1 : 0) as $article)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ Str::limit($article->title, 60) }}</h5>
                                    <p class="card-text flex-grow-1">{{ Str::limit($article->excerpt, 100) }}</p>
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <small class="text-muted">
                                                <i class="fas fa-user me-1"></i>{{ $article->author->name }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-clock me-1"></i>{{ $article->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        <a href="{{ route('news.show', $article->slug) }}" class="btn btn-outline-primary btn-sm">
                                            Read More <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $news->withQueryString()->links() }}
                </div>
            @else
                <!-- No Articles Found -->
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">No articles found</h4>
                    <p class="text-muted">
                        @if(request('search'))
                            No articles match your search criteria. Try different keywords.
                        @else
                            There are currently no published articles available.
                        @endif
                    </p>
                    @if(request('search'))
                        <a href="{{ route('news.index') }}" class="btn btn-primary">View All Articles</a>
                    @endif
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Recent Articles Widget -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-clock me-2"></i>Recent Articles
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $recentNews = \App\Models\News::where('status', 'published')
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp
                    @forelse($recentNews as $recent)
                        <div class="d-flex mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                            @if($recent->image)
                                <img src="{{ asset('storage/' . $recent->image) }}" alt="{{ $recent->title }}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    <a href="{{ route('news.show', $recent->slug) }}" class="text-decoration-none">
                                        {{ Str::limit($recent->title, 50) }}
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    {{ $recent->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">No recent articles</p>
                    @endforelse
                </div>
            </div>

            <!-- Categories Widget (Optional) -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-tags me-2"></i>Quick Stats
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h4 class="text-primary">{{ \App\Models\News::where('status', 'published')->count() }}</h4>
                            <small class="text-muted">Published</small>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success">{{ \App\Models\News::whereMonth('created_at', now()->month)->count() }}</h4>
                            <small class="text-muted">This Month</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Newsletter Signup (Optional) -->
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5 class="mb-3">
                        <i class="fas fa-envelope me-2"></i>Stay Updated
                    </h5>
                    <p class="mb-3">Get the latest tourism news and updates delivered to your inbox.</p>
                    <a href="#" class="btn btn-light">Subscribe Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection