<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::paginate(10);
        return view("admin.destinations.index", compact("destinations"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'entrance_fee' => 'nullable|numeric|min:0',
            'availability' => 'boolean',
            'social_media' => 'nullable|json',
        ]);

        $destination = Destination::create($validated);

        return redirect()->route('admin.destinations.index')->with('success', 'Destination created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        $feedbacks = $destination->feedback()->orderBy('created_at', 'desc')->paginate(5);
        $videos = $destination->videos()->orderBy('created_at', 'desc')->paginate(5);
        return view("admin.destinations.show", compact('destination', 'feedbacks', 'videos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'entrance_fee' => 'nullable|numeric|min:0',
            'availability' => 'boolean',
            'social_media' => 'nullable|json',
        ]);

        $destination->update($validated);
        return redirect()->route('admin.destinations.show', $destination)->with('success', 'Destination updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Destination deleted successfully');
    }
}
