<?php
namespace App\Observers;

use App\Models\Review;

class ReviewObserver
{
    public function updated(Review $review): void
    {
        if ($review->isDirty('status') && $review->status === 'approved') {
            $review->destination->updateRating();
        }
    }

    public function deleted(Review $review): void
    {
        if ($review->status === 'approved') {
            $review->destination->updateRating();
        }
    }
}