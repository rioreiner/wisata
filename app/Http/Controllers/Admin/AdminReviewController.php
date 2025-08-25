<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'destination']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $reviews = $query->latest()->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function updateStatus(Request $request, Review $review)
    {
        $request->validate([
            'status' => 'required|in:approved,pending,rejected'
        ]);

        $review->update(['status' => $request->status]);

        // Update destination rating if review is approved
        if ($request->status === 'approved') {
            $review->destination->updateRating();
        }

        return back()->with('success', 'Review status updated successfully');
    }
}