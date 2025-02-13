<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('start_date', 'asc')->get()->groupBy(function ($event) {
            return \Carbon\Carbon::parse($event->start_date)->format('F Y'); // Group by Month and Year
        });
    
        return view('admin.events.index', compact('events'));
    }
    

    // Show the form for creating a new event
    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        // Debug request data to ensure 'source' is present
        // dd($request->all());

        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'history' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'source' => 'nullable|string|max:255',
        ]);

        // Handle the event image if uploaded
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        // Create a new event
        $event = Event::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'history' => $validated['history'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'image' => $imagePath,
            'source' => $validated['source'] ?? null, // Save the 'source' or null
        ]);
        activity()->log('admin created event');

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    }






    // Show the form for editing the specified event
    public function edit($id)
    {

        $event = Event::findOrFail($id); // Retrieve the event by its ID
        return view('admin.events.edit', compact('event')); // Pass the event to the edit view
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'history' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image' => 'nullable|image|max:1024',
            'source' => 'nullable|string|max:255', // Validate the source field
        ]);

        // Handle file upload (if any)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $event->image = $imagePath;
        }

        // Update the event
        $event->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'history' => $request->input('history'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'source' => $request->input('source'), // Update the source
        ]);

        activity()->log('admin updated event');

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully');
    }





    public function show($id)
    {


        $event = Event::findOrFail($id); // Retrieve the event by its ID
        return view('admin.events.show', compact('event'));
    }


}
