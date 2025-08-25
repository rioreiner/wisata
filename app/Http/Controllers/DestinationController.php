<?php
// app/Http/Controllers/DestinationController.php
namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::where('status', 'active');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        $destinations = $query->paginate(12);

        return view('destinations.index', compact('destinations'));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)
                                 ->where('status', 'active')
                                 ->firstOrFail();

        $reviews = $destination->approvedReviews()
                             ->with('user')
                             ->latest()
                             ->paginate(10);

        return view('destinations.show', compact('destination', 'reviews'));
    }
}