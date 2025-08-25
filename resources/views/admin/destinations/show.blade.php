@extends('admin.layouts.app')

@section('title', 'Destination Details')

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h5>Destination Details</h5>
            </div>
            <div class="card-body">
                
                <!-- Nama & Lokasi -->
                <h3 class="fw-bold">{{ $destination->name }}</h3>
                <p class="text-muted">
                    <i class="fas fa-map-marker-alt"></i> {{ $destination->location }}
                </p>

                <!-- Gambar -->
                @if($destination->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $destination->image) }}" 
                             alt="{{ $destination->name }}" 
                             class="img-fluid rounded shadow-sm" 
                             style="max-height: 400px; object-fit: cover;">
                    </div>
                @endif

                <!-- Deskripsi -->
                <div class="mb-4">
                    <h5>Description</h5>
                    <p>{{ $destination->description }}</p>
                </div>

                <!-- Harga -->
                <div class="mb-4">
                    <h5>Price</h5>
                    <p class="fw-bold text-primary">Rp {{ number_format($destination->price, 0, ',', '.') }}</p>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <h5>Status</h5>
                    @if($destination->status == 'active')
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </div>

                <!-- Action -->
                <div class="d-flex">
                    <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary me-2">
                        Back
                    </a>
                    <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-primary me-2">
                        Edit
                    </a>
                    <form action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
