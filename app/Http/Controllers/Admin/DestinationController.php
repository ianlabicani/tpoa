<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Hotel;
use App\Models\Video;
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
            'events' => 'nullable|string|max:255',
            'social_media' => 'nullable|string|max:5000',
            'service_offer' => 'nullable|string|max:5000',
            'how_to_get_there' => 'nullable|string|max:5000',
            'day_images' => 'nullable|array',
            'night_images' => 'nullable|array',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'history' => 'nullable|string|max:5000',
            'description' => 'nullable|string|max:5000',
            'image_source' => 'nullable|string|max:100',
            'service_offer_image' => 'nullable|array',

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

        // Save service offer images if present
        if ($request->hasFile('service_offer_image')) {
            $serviceOfferImages = [];
            foreach ($request->file('service_offer_image') as $image) {
                $serviceOfferImages[] = $image->store('images/service_offer', 'public');
            }
            $validated['service_offer_image'] = json_encode($serviceOfferImages); // Save as a JSON array of file paths
        }

        // Create a new destination with the validated data
        $destination = Destination::create($validated);
        activity()->log('admin created destination');

        return redirect()->route('admin.destinations.show', $destination)->with('success', 'Destination created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        $feedbacks = $destination->feedbacks()->orderBy('created_at', 'desc')->paginate(5);
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
            'events' => 'nullable|string|max:255',
            'social_media' => 'nullable|string|max:5000',
            'service_offer' => 'nullable|string|max:5000',
            'how_to_get_there' => 'nullable|string|max:5000',
            'day_images' => 'nullable|array',
            'night_images' => 'nullable|array',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'history' => 'nullable|string|max:5000',
            'description' => 'nullable|string|max:5000',
            'image_source' => 'nullable|string|max:100',
            'service_offer_image' => 'nullable|array',
            'service_offer_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image file
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

        // Save service offer images if present
        if ($request->hasFile('service_offer_image')) {
            $serviceOfferImages = [];
            foreach ($request->file('service_offer_image') as $image) {
                $serviceOfferImages[] = $image->store('images/service_offer', 'public');
            }
            $validated['service_offer_image'] = json_encode($serviceOfferImages);  // Save as a JSON array of file paths
        }

        // Update the destination with the validated data
        $destination->update($validated);
        activity()->log('admin updated destination');

        return redirect()->route('admin.destinations.show', $destination)->with('success', 'Destination updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();
        activity()->log('admin deleted destination');
        return redirect()->route('admin.destinations.index')->with('success', 'Destination deleted successfully');
    }




    // Method to manage feedbacks
    public function manageFeedbacks()
    {
        // Fetch feedbacks associated with destinations
        $feedbacks = Feedback::with('user', 'reactions', 'destination') // Eager load related data
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        // Pass feedbacks to the view
        return view('admin.feedbacks.index', compact('feedbacks'));
    }


    public function manageActivityLogs()
    {

        // Pass feedbacks to the view
        return view('admin.activity-logs.index');
    }

    public function details()
    {
        $visitorCounts = Destination::withCount([
            'feedbacks as likes_count' => function ($query) {
                $query->whereHas('reactions', function ($query) {
                    $query->where('reaction', 'like');
                });
            },
            'feedbacks as dislikes_count' => function ($query) {
                $query->whereHas('reactions', function ($query) {
                    $query->where('reaction', 'dislike');
                });
            }
        ])
            ->paginate(9); // Paginate destinations with reaction counts

        return view("admin.details", compact('visitorCounts'));
    }
}
