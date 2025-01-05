<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::paginate(9);
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
            'contact' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'entrance_fee' => 'nullable|numeric|min:0',
            'availability' => 'boolean',
            'social_media' => 'nullable|string|max:5000',
            'service_offer' => 'nullable|string|max:5000',
            'how_to_get_there' => 'nullable|string|max:5000',
            'day_images' => 'nullable|array',
            'night_images' => 'nullable|array',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Save day images if present
        if ($request->hasFile('day_images')) {
            $dayImages = [];
            foreach ($request->file('day_images') as $image) {
                $dayImages[] = $image->store('images/day', 'public');
            }
            $validated['day_images'] = json_encode($dayImages); // Save as a JSON array of file paths
        }

        // Save night images if present
        if ($request->hasFile('night_images')) {
            $nightImages = [];
            foreach ($request->file('night_images') as $image) {
                $nightImages[] = $image->store('images/night', 'public');
            }
            $validated['night_images'] = json_encode($nightImages); // Save as a JSON array of file paths
        }


        // Create a new destination with the validated data
        $destination = Destination::create($validated);

        return redirect()->route('admin.destinations.show', $destination)->with('success', 'Destination created successfully');
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
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'entrance_fee' => 'nullable|numeric|min:0',
            'availability' => 'boolean',
            'social_media' => 'nullable|string|max:5000',
            'service_offer' => 'nullable|string|max:5000',
            'how_to_get_there' => 'nullable|string|max:5000',
            'day_images' => 'nullable|array',
            'night_images' => 'nullable|array',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',

        ]);



        // Save day images if present
        if ($request->hasFile('day_images')) {
            $dayImages = [];
            foreach ($request->file('day_images') as $image) {
                $dayImages[] = $image->store('images/day', 'public');
            }
            $validated['day_images'] = json_encode($dayImages);  // Save as a JSON array of file paths
        }

        // Save night images if present
        if ($request->hasFile('night_images')) {
            $nightImages = [];
            foreach ($request->file('night_images') as $image) {
                $nightImages[] = $image->store('images/night', 'public');
            }
            $validated['night_images'] = json_encode($nightImages);  // Save as a JSON array of file paths
        }

        // Update the destination with the validated data
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
