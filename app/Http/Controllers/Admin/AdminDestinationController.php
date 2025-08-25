<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminDestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->paginate(10);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        Destination::create($data);

        return redirect()->route('admin.destinations.index')
                        ->with('success', 'Destination created successfully');
    }

    public function show(Destination $destination)
    {
        return view('admin.destinations.show', compact('destination'));
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($data);

        return redirect()->route('admin.destinations.index')
                        ->with('success', 'Destination updated successfully');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('admin.destinations.index')
                        ->with('success', 'Destination deleted successfully');
    }
}
