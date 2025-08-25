@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="jumbotron bg-primary text-white text-center mb-5 p-5 rounded">
        <h1 class="display-4">Welcome to Tourism System</h1>
        <p class="lead">Discover amazing destinations and create unforgettable memories</p>
        <a class="btn btn-light btn-lg" href="{{ route('destinations.index') }}" role="button">
            Explore Destinations
        </a>
    </div>

    <!-- Top Destinations -->
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="mb-4">Top Destinations</h2>
            <div class="row">
                @forelse($destinations as $destination)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($destination->image)
                                <img src="{{ asset('storage/' . $destination->image) }}" class="card-img-top" alt="{{ $destination->name }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $destination->name }}</h5>
                                <p class="card-text">{{ Str::limit($destination->description, 100) }}</p>
                                <p class="text-muted">
                                    <i class="fas fa-map-marker-alt"></i> {{ $destination->location }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-primary fw-bold">Rp {{ number_format($destination->price, 0, ',', '.') }}</span>
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i <= $destination->rating ? '' : '-o' }}"></i>
                                        @endfor
                                        <small>({{ $destination->rating }})</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('destinations.show', $destination->slug) }}" class="btn btn-primary btn-sm">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">No destinations available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Latest News -->
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Latest News</h2>
            <div class="row">
                @forelse($news as $article)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <p class="card-text">{{ $article->excerpt }}</p>
                                <small class="text-muted">By {{ $article->author->name }} | {{ $article->created_at->format('M d, Y') }}</small>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('news.show', $article->slug) }}" class="btn btn-outline-primary btn-sm">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">No news available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection