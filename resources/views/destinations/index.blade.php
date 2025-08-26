@extends('layouts.app')

@section('content')
<div class="container mt-5 px-3">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">All Destinations</h1>
            
            <!-- Search Form -->
            <form method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-8 mb-2 mb-md-0">
                        <input type="text" name="search" class="form-control" placeholder="Search destinations..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('destinations.index') }}" class="btn btn-secondary w-100">Clear</a>
                        @endif
                    </div>
                </div>
            </form>

            <div class="row">
                @forelse($destinations as $destination)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0 rounded-3">
                            @if($destination->image)
                                <img src="{{ asset('storage/' . $destination->image) }}" 
                                     class="card-img-top rounded-top" 
                                     alt="{{ $destination->name }}" 
                                     style="height: 250px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $destination->name }}</h5>
                                <p class="card-text">{{ Str::limit($destination->description, 120) }}</p>
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
                            <div class="card-footer bg-white border-0">
                                <a href="{{ route('destinations.show', $destination->slug) }}" class="btn btn-primary w-100">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No destinations found. 
                            @if(request('search')) Try different search terms. @endif
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $destinations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
