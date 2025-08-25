@extends('admin.layouts.app')

@section('title', 'Manage Destinations')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Destinations</h2>
    <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Destination
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinations as $destination)
                        <tr>
                            <td>
                                @if($destination->image)
                                    <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}" class="rounded me-2" width="50" height="50">
                                @endif
                                {{ $destination->name }}
                            </td>
                            <td>{{ $destination->location }}</td>
                            <td>Rp {{ number_format($destination->price, 0, ',', '.') }}</td>
                            <td>
                                <div class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $destination->rating ? '' : '-o' }}"></i>
                                    @endfor
                                    <small>({{ $destination->rating }})</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-{{ $destination->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($destination->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.destinations.show', $destination) }}" class="btn btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.destinations.edit', $destination) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No destinations found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $destinations->links() }}
    </div>
</div>
@endsection