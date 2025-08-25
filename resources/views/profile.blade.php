@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5>User Profile</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" disabled>
                            <small class="form-text text-muted">Email cannot be changed.</small>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', auth()->user()->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5>My Reviews</h5>
                </div>
                <div class="card-body">
                    @forelse(auth()->user()->reviews()->with('destination')->latest()->take(5)->get() as $review)
                        <div class="border-bottom mb-3 pb-3">
                            <h6>{{ $review->destination->name }}</h6>
                            <div class="text-warning mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                            <p class="mb-1">{{ $review->comment }}</p>
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                <span class="badge bg-{{ $review->status == 'approved' ? 'success' : ($review->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($review->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">You haven't written any reviews yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection