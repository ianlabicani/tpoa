<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller


{
    public function index()
    {
        $events = Event::paginate(5);
        return view('admin.events.index', compact('events'));
    }
    
    // Show the form for creating a new event
    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image
        ]);
        
        // Handle the event image if it's uploaded
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public'); // Store image in 'events' folder
        }
        
        // Create a new event with the validated data
        $event = Event::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'image' => $imagePath, // Save the image path in the database
        ]);
        
        // Redirect to the event's show page with success message
        return redirect()->route('admin.events.show', ['event' => $event->id])->with('success', 'Event created successfully!');
    }
    
    
    
    

 // Show the form for editing the specified event
 public function edit($id)
 {
    
     $event = Event::findOrFail($id); // Retrieve the event by its ID
     return view('admin.events.edit', compact('event')); // Pass the event to the edit view
 }

 public function update(Request $request, Event $event)
 {
     // Validate the incoming request
     $validated = $request->validate([
         'name' => 'required|string|max:255',
         'description' => 'nullable|string',
         'start_date' => 'required|date',
         'end_date' => 'required|date',
         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image
     ]);
     
     // Handle image upload if present
     if ($request->hasFile('image')) {
         $validated['image'] = $request->file('image')->store('events', 'public'); // Store new image
     }
     
     // Update the event with the validated data
     $event->update($validated);
     
     // Redirect to the updated event's show page
     return redirect()->route('admin.events.show', ['event' => $event->id])->with('success', 'Event updated successfully!');
 }
 
 
 

 public function show($id)
 {
   
   
    $event = Event::findOrFail($id); // Retrieve the event by its ID
    return view('admin.events.show', compact('event'));
 }
 

}
