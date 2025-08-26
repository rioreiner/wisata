@extends('layouts.app')

@section('content')
<div class="container mt-5"> {{-- tambahkan margin top --}}
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                @if($destination->image)
                    <img src="{{ asset('storage/' . $destination->image) }}" class="card-img-top" alt="{{ $destination->name }}" style="height: 400px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h1 class="card-title">{{ $destination->name }}</h1>
                    <p class="text-muted mb-3">
                        <i class="fas fa-map-marker-alt"></i> {{ $destination->location }}
                    </p>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h4 text-primary">Rp {{ number_format($destination->price, 0, ',', '.') }}</span>
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $destination->rating ? '' : '-o' }}"></i>
                                @endfor
                                <small>({{ $destination->rating }}) - {{ $destination->reviews->count() }} reviews</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Description</h5>
                        <p>{{ $destination->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5>Reviews</h5>
                </div>
                <div class="card-body">
                    @auth
                        @if(!$destination->reviews()->where('user_id', auth()->id())->exists())
                            <form method="POST" action="{{ route('reviews.store') }}" class="mb-4">
                                @csrf
                                <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                                
                                <div class="mb-3">
                                    <label class="form-label">Rating</label>
                                    <select name="rating" class="form-select" required>
                                        <option value="">Select Rating</option>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Stars</option>
                                        <option value="3">3 Stars</option>
                                        <option value="4">4 Stars</option>
                                        <option value="5">5 Stars</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Comment</label>
                                    <textarea name="comment" class="form-control" rows="3" required></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </form>
                        @endif
                    @else
                        <p class="text-muted">Please <a href="{{ route('login') }}">login</a> to write a review.</p>
                    @endauth

                    @forelse($reviews as $review)
                        <div class="border-bottom mb-3 pb-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">{{ $review->user->name }}</h6>
                                <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                            </div>
                            <div class="text-warning mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                            <p class="mb-0">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <p class="text-muted">No reviews yet. Be the first to review!</p>
                    @endforelse

                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6>Quick Info</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>Location:</strong><br>
                            {{ $destination->location }}
                        </li>
                        <li class="mb-2">
                            <strong>Price:</strong><br>
                            Rp {{ number_format($destination->price, 0, ',', '.') }}
                        </li>
                        <li class="mb-2">
                            <strong>Rating:</strong><br>
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $destination->rating ? '' : '-o' }}"></i>
                                @endfor
                                <span class="text-dark">({{ $destination->rating }})</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
