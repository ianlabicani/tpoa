<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::paginate(10);
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'price_per_night' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
            'social_media' => 'nullable|json',
            'services' => 'nullable|string',
            'availability' => 'boolean',
        ]);

        // dd($validated);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('hotels/covers', 'public');
        }

        $hotel = Hotel::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('hotels/images', 'public');
                $hotel->images()->create(['path' => $path]);
            }
        }

        activity()->log("Hotel '{$hotel->name}' created successfully.");

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel added successfully.');
    }

    public function show(Hotel $hotel)
    {
        return view('admin.hotels.show', compact('hotel'));
    }
    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }
    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'price_per_night' => 'nullable|numeric',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'social_media' => 'nullable|json',
            'services' => 'nullable|string',
            'availability' => 'boolean',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('hotels', 'public');
        }

        $hotel->update($validated);
        activity()->log('Hotel updated successfully.');


        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully.');
    }
    public function destroy(Hotel $hotel)
    {
        if ($hotel->cover) {
            Storage::delete('public/' . $hotel->cover);
        }

        $hotel->delete();
        activity()->log('Hotel deleted successfully.');

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully.');
    }


}
