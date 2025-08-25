<?php
// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\News;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $destinations = Destination::where('status', 'active')
                                 ->orderBy('rating', 'desc')
                                 ->take(6)
                                 ->get();
        
        $news = News::where('status', 'published')
                   ->latest()
                   ->take(3)
                   ->get();

        return view('home', compact('destinations', 'news'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string'
        ]);

        auth()->user()->update($request->only(['name', 'phone', 'address']));

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}