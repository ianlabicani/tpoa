<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::query();
    
        // Apply search filter if search query is provided
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        $destinations = $query->paginate(9); // Adjust number per page as needed
    
        return view('user.destinations.index', compact('destinations'));
    }
    

    public function show(Destination $destination)
    {
        // Retrieve feedbacks for the destination
        $feedbacks = $destination->feedbacks()->orderBy('created_at', 'desc')->paginate(5);
    
        // Retrieve videos for the destination
        $videos = $destination->videos()->orderBy('created_at', 'desc')->paginate(5);
    
        return view('user.destinations.show', compact('destination', 'feedbacks', 'videos'));
    }
    
    
    
}
