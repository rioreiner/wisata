@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <article class="card">
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 400px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h1 class="card-title">{{ $article->title }}</h1>
                    <div class="text-muted mb-4">
                        <small>
                            <i class="fas fa-user"></i> By {{ $article->author->name }} | 
                            <i class="fas fa-calendar"></i> {{ $article->created_at->format('F d, Y') }}
                        </small>
                    </div>
                    
                    <div class="article-content">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </div>
            </article>

            <div class="mt-4 text-center">
                <a href="{{ route('news.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Back to News
                </a>
            </div>
        </div>
    </div>
</div>
@endsection