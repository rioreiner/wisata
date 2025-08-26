@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row row-cards">
    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="bg-primary text-white avatar me-3"><i class="fas fa-map-marked-alt"></i></span>
                    <div>
                        <div class="h2 mb-0">{{ $stats['destinations'] }}</div>
                        <div class="text-muted">Destinations</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="bg-success text-white avatar me-3"><i class="fas fa-newspaper"></i></span>
                    <div>
                        <div class="h2 mb-0">{{ $stats['news'] }}</div>
                        <div class="text-muted">News Articles</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="bg-warning text-white avatar me-3"><i class="fas fa-star"></i></span>
                    <div>
                        <div class="h2 mb-0">{{ $stats['reviews'] }}</div>
                        <div class="text-muted">Total Reviews</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="bg-info text-white avatar me-3"><i class="fas fa-users"></i></span>
                    <div>
                        <div class="h2 mb-0">{{ $stats['users'] }}</div>
                        <div class="text-muted">Users</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($stats['pending_reviews'] > 0)
    <div class="alert alert-important alert-warning mt-4">
        <i class="fas fa-exclamation-triangle"></i>
        You have <strong>{{ $stats['pending_reviews'] }}</strong> pending review(s).
        <a href="{{ route('admin.reviews.index') }}" class="alert-link">Review now</a>
    </div>
@endif

<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Recent Reviews</h3>
    </div>
    <div class="card-body">
        @forelse($recent_reviews as $review)
            <div class="mb-3 pb-3 border-bottom">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>{{ $review->destination->name }}</strong><br>
                        <span class="text-muted">{{ Str::limit($review->comment, 100) }}</span><br>
                        <small class="text-muted">
                            By {{ $review->user->name }} | {{ $review->created_at->format('M d, Y H:i') }}
                        </small>
                    </div>
                    <div class="text-end">
                        <div class="text-warning">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                            @endfor
                        </div>
                        <span class="badge bg-{{ $review->status == 'approved' ? 'success text-white' : ($review->status == 'pending text-white' ? 'warning' : 'danger text-white') }}">
                            {{ ucfirst($review->status) }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">No reviews yet</p>
        @endforelse
    </div>
</div>
@endsection
