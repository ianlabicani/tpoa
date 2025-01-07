<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class UserController extends Controller
{
    
    //FOR USER

    public function events()
    {
        $events = Event::all();
        return view('user.about-aparri.events.index', compact('events'));
    }

    public function show($id)
    {
      
       $event = Event::findOrFail($id); // Retrieve the event by its ID
       return view('user.about-aparri.events.show', compact('event'));
    }
     


}
