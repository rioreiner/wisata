@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $stats['destinations'] }}</h4>
                        <p>Destinations</p>
                    </div>
                    <div>
                        <i class="fas fa-map-marked-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $stats['news'] }}</h4>
                        <p>News Articles</p>
                    </div>
                    <div>
                        <i class="fas fa-newspaper fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $stats['reviews'] }}</h4>
                        <p>Total Reviews</p>
                    </div>
                    <div>
                        <i class="fas fa-star fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $stats['users'] }}</h4>
                        <p>Users</p>
                    </div>
                    <div>
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($stats['pending_reviews'] > 0)
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle"></i>
    You have {{ $stats['pending_reviews'] }} pending review(s) to approve.
    <a href="{{ route('admin.reviews.index') }}" class="alert-link">Review now</a>
</div>
@endif

<div class="card">
    <div class="card-header">
        <h5>Recent Reviews</h5>
    </div>
    <div class="card-body">
        @forelse($recent_reviews as $review)
            <div class="border-bottom mb-3 pb-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6>{{ $review->destination->name }}</h6>
                        <p class="mb-1">{{ Str::limit($review->comment, 100) }}</p>
                        <small class="text-muted">By {{ $review->user->name }} | {{ $review->created_at->format('M d, Y H:i') }}</small>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="text-warning mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                            @endfor
                        </div>
                        <span class="badge bg-{{ $review->status == 'approved' ? 'success' : ($review->status == 'pending' ? 'warning' : 'danger') }}">
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