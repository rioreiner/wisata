@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 50) }}</li>
                </ol>
            </nav>

            <!-- Article Header -->
            <article class="card shadow-sm mb-4">
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 400px; object-fit: cover;">
                @endif
                
                <div class="card-body">
                    <!-- Article Meta -->
                    <div class="mb-4">
                        <span class="badge bg-primary mb-2">News Article</span>
                        <h1 class="card-title display-5 mb-3">{{ $article->title }}</h1>
                        
                        <div class="row text-muted mb-3">
                            <div class="col-md-6">
                                <i class="fas fa-user me-2"></i>
                                <strong>By:</strong> {{ $article->author->name }}
                            </div>
                            <div class="col-md-6">
                                <i class="fas fa-calendar me-2"></i>
                                <strong>Published:</strong> {{ $article->created_at->format('F d, Y') }}
                            </div>
                        </div>

                        <div class="row text-muted mb-4">
                            <div class="col-md-6">
                                <i class="fas fa-clock me-2"></i>
                                <strong>Reading Time:</strong> {{ ceil(str_word_count($article->content) / 200) }} min read
                            </div>
                            <div class="col-md-6">
                                <i class="fas fa-eye me-2"></i>
                                <strong>Last Updated:</strong> {{ $article->updated_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>

                    <!-- Article Excerpt -->
                    @if($article->excerpt)
                        <div class="alert alert-light border-start border-primary border-4 mb-4">
                            <h6 class="alert-heading">Summary</h6>
                            <p class="mb-0 lead">{{ $article->excerpt }}</p>
                        </div>
                    @endif
                    
                    <!-- Article Content -->
                    <div class="article-content" style="line-height: 1.8;">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    <!-- Share Buttons -->
                    <div class="border-top pt-4 mt-4">
                        <h6 class="mb-3">Share this article:</h6>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . request()->fullUrl()) }}" target="_blank" class="btn btn-outline-success btn-sm">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            <button onclick="copyToClipboard('{{ request()->fullUrl() }}')" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-copy"></i> Copy Link
                            </button>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Author Info -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">{{ $article->author->name }}</h5>
                            <p class="text-muted mb-0">Tourism Writer & Content Creator</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            @php
                $relatedNews = \App\Models\News::where('status', 'published')
                    ->where('id', '!=', $article->id)
                    ->inRandomOrder()
                    ->take(3)
                    ->get();
            @endphp
            
            @if($relatedNews->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-newspaper me-2"></i>Related Articles
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($relatedNews as $related)
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 border-0">
                                        @if($related->image)
                                            <img src="{{ asset('storage/' . $related->image) }}" class="card-img-top rounded" alt="{{ $related->title }}" style="height: 150px; object-fit: cover;">
                                        @endif
                                        <div class="card-body p-2">
                                            <h6 class="card-title">
                                                <a href="{{ route('news.show', $related->slug) }}" class="text-decoration-none">
                                                    {{ Str::limit($related->title, 60) }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">
                                                {{ $related->created_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Navigation -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('news.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to News
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-home me-2"></i>Home
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Link copied to clipboard!');
    });
}
</script>
@endsection