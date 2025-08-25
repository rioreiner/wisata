<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Destination, News, Review, User};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'destinations' => Destination::count(),
            'news' => News::count(),
            'reviews' => Review::count(),
            'users' => User::where('role', 'user')->count(),
            'pending_reviews' => Review::where('status', 'pending')->count()
        ];

        $recent_reviews = Review::with(['user', 'destination'])
                               ->latest()
                               ->take(5)
                               ->get();

        return view('admin.dashboard', compact('stats', 'recent_reviews'));
    }
}