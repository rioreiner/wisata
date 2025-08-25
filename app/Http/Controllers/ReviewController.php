<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Destination;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000'
        ]);

        // Check if user already reviewed this destination
        $existingReview = Review::where('user_id', auth()->id())
                              ->where('destination_id', $request->destination_id)
                              ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this destination');
        }

        Review::create([
            'user_id' => auth()->id(),
            'destination_id' => $request->destination_id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Review submitted successfully and waiting for approval');
    }
}
