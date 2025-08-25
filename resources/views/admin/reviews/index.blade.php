@extends('admin.layouts.app')

@section('title', 'Manage Reviews')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Reviews</h2>
    <form method="GET" class="d-flex">
        <select name="status" class="form-select me-2">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
</div>

<div class="card">
    <div class="card-body">
        @forelse($reviews as $review)
            <div class="border-bottom mb-3 pb-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6>{{ $review->destination->name }}</h6>
                        <p class="mb-1">{{ $review->comment }}</p>
                        <small class="text-muted">
                            By {{ $review->user->name }} | {{ $review->created_at->format('M d, Y H:i') }}
                        </small>
                    </div>
                    <div class="col-md-4">
                        <div class="text-warning mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                            @endfor
                        </div>
                        <div class="mb-2">
                            <span class="badge bg-{{ $review->status == 'approved' ? 'success' : ($review->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($review->status) }}
                            </span>
                        </div>
                        <div class="btn-group btn-group-sm">
                            @if($review->status != 'approved')
                                <form action="{{ route('admin.reviews.status', $review) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
                            @endif
                            @if($review->status != 'rejected')
                                <form action="{{ route('admin.reviews.status', $review) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">No reviews found</p>
        @endforelse

        {{ $reviews->links() }}
    </div>
</div>
@endsection